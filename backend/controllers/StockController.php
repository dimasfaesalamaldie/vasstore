<?php

namespace backend\controllers;

use backend\models\Cetak;
use backend\models\PrintData;
use common\models\Barang;
use common\models\BarangSearch;
use common\models\Penjualan;
use common\models\SafetyStock;
use common\models\SafetyStockSearch;
use common\models\Stock;
use DateTime;
use kartik\mpdf\Pdf;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * StockController implements the CRUD actions for Stock model.
 */
class StockController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Displays a single Stock model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $searchModel = new SafetyStockSearch();
        $searchModel->sku_barang = $id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('view', [
            'model' => Barang::findOne($id),
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    private function getData($barang, $size)  // fungsi untuk mengambil penjualan max dan jumlah penjualan dalam 1 tahun terakhir
    {
        $count = 0; // inisialiasi nilai awal
        $max = 0;//inisialisasi nilai awal
        $start = DateTime::createFromFormat('Y-m-d', date('Y-m-01', strtotime("-1 year", time())));
        $start->modify('+1 month');
        for ($i = 0; $i < 12; $i++) {
            $temp = 0;
            foreach (Penjualan::find()->where(['between', 'DATE(tanggal_penjualan)', $start->format('Y-m-01'), $start->format('Y-m-t')])->all() as $pen) {
                foreach ($pen->detailPenjualans as $det) {
                    if ($det->sku_barang === $barang->sku && $det->size == $size) {
                        $count += $det->jumlah;
                        $temp += $det->jumlah;
                    }
                }
            }
            $max = $max > $temp ? $max : $temp;
            $start->modify('+1 month');
        }
        return [$count, $max]; // count = jumlah penjualan, max = penjualan maksimal
    }

    private function createSafetyStock($barang, $size, $stock)
    {
        $sf = SafetyStock::find()->andWhere(['sku_barang' => $barang->sku, 'size' => $size])->one();
        if ($sf === null) {
            $sf = new SafetyStock();
            $sf->sku_barang = $barang->sku;
            $sf->size = $size;
        }
        $data = $this->getData($barang, $size);
        $sf->terjual = $data[0]; // penjualan dalam satu tahun terakhir
        $sf->max = $data[1];// maksimal jumlah penjualan dalam satu bulan dalam satu tahun terakhir
        $sf->rerata = $sf->terjual / 12;
        $sf->leadtime = $barang->leadtime;
        $sf->stock = $stock;
        $sf->safety_stock = (int) (($sf->max - $sf->rerata) * $barang->leadtime); // hitung dengan rumus safety stock
        if ($stock == 0) {
            $sf->status = 2;
        } else {
            $sf->status = $sf->stock >= $sf->safety_stock ? 1 : 2; // jika stock kurang dari safety stock berarti status unsafe dan sebaliknya
        }
        
        $sf->rop = (int) ($sf->safety_stock + ($barang->leadtime * ($sf->terjual / 365))); // hitung dengan rumus rop

        $sf->save();
    }

    private function syncSafetyStock()
    {
        $barang = null;
        $size = null;
        $stock = 0;
        foreach (Stock::find()->orderBy(['sku_barang' => SORT_ASC, 'size' => SORT_ASC])->all() as $st) {
            if ($barang === null) { // kelompokkan stock berdasarkan barang & ukuran
                $barang = Barang::findOne($st->sku_barang);
                $size = $st->size;
                $stock = 0;
                $barang->stock = 0;
            }
            $created = false;
            if ($size != $st->size) {
                $barang->stock += $stock;
                $barang->save(); // jika sudah buat safety stock
                $this->createSafetyStock($barang, $size, $stock);
                $created = true;
                $size = $st->size;
                $stock = 0;
            }
            if ($barang->sku !== $st->sku_barang) {
                if (!$created) {
                    $barang->stock += $stock;
                    $barang->save(); // jika sudah buat safety stock
                    $this->createSafetyStock($barang, $size, $stock);
                }
                $barang = Barang::findOne($st->sku_barang);
                $size = $st->size;
                $stock = 0;
                $barang->stock = 0;
            }
            $stock += $st->stock_real;
        }

        if ($barang !== null && $size !== null) {
            $barang->stock += $stock;
            $barang->save();
            $this->createSafetyStock($barang, $size, $stock);
        }

        foreach (Barang::find()->andWhere(['aktif' => 1])->all() as $ba) {
            $ba->status = SafetyStock::find()->andWhere(['sku_barang' => $ba->sku, 'status' => 2])->one() === null ? 1 : 2;
            $ba->save();
        }
    }

    /**
     * Lists all Stock models.
     * @return mixed
     */

    public function actionLoad()
    {
        $this->syncSafetyStock();
        return $this->redirect(['index']);

    }

    public function actionIndex()//langkah eoq
    {
        $searchModelUnsafe = new SafetyStockSearch();
        $searchModelUnsafe->aktif = 1;
        $searchModelUnsafe->sort = 1;
        $searchModelUnsafe->status = 2;
        $dataProviderUnsafe = $searchModelUnsafe->search(Yii::$app->request->queryParams);

        $data = new PrintData();
        $data->search = $searchModelUnsafe;

        $cetak = new Cetak();

        if ($data->load(Yii::$app->request->post())) {
            // get your HTML raw content without any layouts or scripts
            $searchModelUnsafe->pagination = false;
            $dataProviderUnsafe = $searchModelUnsafe->search(Yii::$app->request->queryParams);
            foreach ($dataProviderUnsafe->query->all() as $sft) {
                $f = false;
                foreach ($cetak->models as $mo) {
                    if ($mo->sku === $sft->sku_barang) {
                        $f = true;
                        break;
                    }
                }
                $cetak->ids[] = $sft->id_safety;
                if (!$f) {
                    $barang = Barang::findOne($sft->sku_barang);
                    $cetak->sku[] = $sft->sku_barang;
                    $cetak->models[$barang->sku] = $barang;
                    $cetak->biaya_penyimpanan[$barang->sku] = $barang->biaya_penyimpanan;
                    $cetak->harga_beli[$barang->sku] = $barang->harga_beli;
                }
            }
            if (!empty($cetak->models)) {
                return $this->render('cetak', [
                    'cetak' => $cetak,
                ]);
            } else {
                Yii::$app->session->setFlash('error', "Tidak ada data !");
            }
        }
        if ($cetak->load(Yii::$app->request->post())) { 
            /*
                setelah input biaya pemesanan dan lain- lain
                maka hitung eoq pake rumus 
            */
            $safetyStocks = [];
            foreach ($cetak->ids as $id) {
                $sft = SafetyStock::findOne($id);
                foreach ($cetak->harga_beli as $key => $hb) {//hitung pada setiap barang yang status unsafe
                    if ($sft->sku_barang === $key) {
                        $sft->skuBarang->harga_beli = str_replace(".", "", $hb);
                        $sft->skuBarang->biaya_penyimpanan = $cetak->biaya_penyimpanan[$key];
                        $sft->skuBarang->biaya_pemesanan = str_replace(".", "", $cetak->biaya_pemesanan);
                        $sft->skuBarang->save(false);
                        $sft->eoq = (2 * $sft->terjual * $sft->skuBarang->biaya_pemesanan)//rumus eoq.
                            / // bagi
                            (($sft->skuBarang->harga_beli * $sft->skuBarang->biaya_penyimpanan) / 100);
                        $sft->eoq = sqrt($sft->eoq);//sqrt = akar
                        $sft->save();
                    }
                }
                $safetyStocks[] = $sft;
            }

            $content = $this->renderPartial('_report', [
                'data' => $safetyStocks,
            ]);

            // setup kartik\mpdf\Pdf component
            $pdf = new Pdf([
                // set to use core fonts only
                'mode' => Pdf::MODE_CORE,
                // A4 paper format
                'format' => Pdf::FORMAT_A4,
                // portrait orientation
                'orientation' => Pdf::ORIENT_LANDSCAPE,
                // stream to browser inline
                //  'destination' => Pdf::DEST_DOWNLOAD,
                'destination' => Pdf::DEST_BROWSER,
                // your html content input
                'content' => $content,
                // format content from your own css file if needed or use the
                // enhanced bootstrap css built by Krajee for mPDF formatting
                'cssFile' => '@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css',
                // any css to be embedded if required
                'cssInline' => '.kv-heading-1{font-size:18px} table {
                    font-family: arial, sans-serif;
                    border-collapse: collapse;
                    width: 100%;
                  }

                  td, th {
                    border: 1px solid #dddddd;
                    text-align: left;
                    padding: 8px;
                  }

                  tr:nth-child(even) {
                    background-color: #dddddd;
                  }',
                // set mPDF properties on the fly
                'options' => ['title' => 'Laporan Order Barang'],
                // call mPDF methods on the fly
                'methods' => [
                    'SetHeader' => ['Data Order Barang'],
                    'SetFooter' => ['{PAGENO}'],
                ],
            ]);
            // return the pdf output as per the destination setting
            
            return $pdf->render();
        }

        $searchModelUnsafe = new SafetyStockSearch();
        $searchModelUnsafe->aktif = 1;
        $searchModelUnsafe->sort = 1;
        $searchModelUnsafe->status = 2;
        $dataProviderUnsafe = $searchModelUnsafe->search(Yii::$app->request->queryParams);

        $searchModelAll = new BarangSearch();
        $searchModelAll->aktif = 1;
        $searchModelAll->sort = 1;
        $dataProviderAll = $searchModelAll->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'data' => $data,
            'searchModelUnsafe' => $searchModelUnsafe,
            'dataProviderUnsafe' => $dataProviderUnsafe,

            'searchModelAll' => $searchModelAll,
            'dataProviderAll' => $dataProviderAll,
        ]);
    }

    
    
    /**
     * Creates a new Stock model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Stock();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_stock]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Stock model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_stock]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Stock model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Stock model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Stock the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Stock::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

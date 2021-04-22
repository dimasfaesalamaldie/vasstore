<?php

namespace backend\controllers;

use Yii;
use common\models\Barang;
use common\models\DetailPembelian;
use common\models\DetailPembelianSearch;
use common\models\Pembelian;
use common\models\PembelianSearch;
use common\models\Stock;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PembelianController implements the CRUD actions for Pembelian model.
 */
class PembelianController extends Controller
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
     * Lists all Pembelian models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PembelianSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Pembelian model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $searchModel = new DetailPembelianSearch();
        $searchModel->no_pembelian = $id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('view', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $this->findModel($id),
        ]);
    }

    private function getNo($not = '', $add = 1)
    {
        $last = Pembelian::find();
        if ($not !== '') {
            $last->andWhere(['<>', 'no_pembelian', $not]);
        }
        $last = $last->orderBy(['no_pembelian' => SORT_DESC])->one();
        $no = 'BVS0000001';
        if ($last !== null) {
            $ln = $last->no_pembelian;
            if (strpos($ln, 'BVS') !== false) {
                $ln = str_replace("BVS", "", $ln);
            }
            $ln = (int) $ln + $add;
            $ln = $ln . '';
            while (strlen($ln) < 7) {
                $ln = '0' . $ln;
            }
            $no = 'BVS' . $ln;
        }
        if (Pembelian::findOne($no) !== null) {
            return $this->getNo($no, $add + 1);
        } else {
            return $no;
        }
    }

    /**
     * Creates a new Pembelian model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Pembelian();
        $model->no_pembelian = $this->getNo();
        $model->dibuat_oleh = Yii::$app->user->identity->username;

        if ($model->load(Yii::$app->request->post())) {
            $model->total_harga = str_replace(".", "", $model->total_harga);
            $model->biaya_pemesanan = str_replace(".", "", $model->biaya_pemesanan);
            $model->tanggal_pembelian = date('Y-m-d H:i:s', strtotime($model->tanggal_pembelian));
            if ($model->save(false)) {
                $total = 0;
                foreach (json_decode($model->detail) as $det) {
                    $detail = new DetailPembelian();
                    $detail->no_pembelian = $model->no_pembelian;
                    $detail->sku_barang = $det->sku;
                    $detail->jumlah = $det->jumlah;
                    $detail->size = $det->size;
                    $detail->harga_satuan = $det->harga_satuan;
                    $total += $det->harga_satuan * $det->jumlah;
                    if($detail->save()) {
                        $stock = new Stock();
                        $stock->sku_barang = $detail->sku_barang;
                        $stock->id_detail = $detail->id_detail;
                        $stock->stock_awal = $detail->jumlah;
                        $stock->stock_real = $detail->jumlah;
                        $stock->size = $detail->size;
                        $stock->save();
                        if(($ba = Barang::findOne($detail->sku_barang)) !== null) {
                            $ba->stock = $ba->stock + $detail->jumlah;
                            $ba->biaya_pemesanan = $model->biaya_pemesanan;
                            $ba->harga_beli = $detail->harga_satuan;
                            $ba->save();
                        }
                    }
                }
                $model->total_harga = $total;
                $model->save(false);
                return $this->redirect(['view', 'id' => $model->no_pembelian]);
            }
        }

        $model->tanggal_pembelian = date('d-m-Y H:i');
        return $this->render('create', [
            'model' => $model,
            'details' => json_encode([]),
            'barangs' => Barang::find()
                ->where(['aktif' => 1])->all(),
            'arr_barangs' => json_encode(Barang::find()
                    ->where(['aktif' => 1])->asArray()->all()),
        ]);
    }
    
    /**
     * Updates an existing Pembelian model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
 
        if ($model->load(Yii::$app->request->post())) {
            $model->total_harga = str_replace(".", "", $model->total_harga);
            $model->tanggal_pembelian = date('Y-m-d H:i:s', strtotime($model->tanggal_pembelian));
            if ($model->save(false)) {
                $total = 0;
                $old_details = DetailPembelian::find()->andWhere(['no_pembelian' => $id])->all();
                foreach (json_decode($model->detail) as $det) {
                    $detail = new DetailPembelian();
                    $detail->no_pembelian = $model->no_pembelian;
                    $detail->sku_barang = $det->sku;
                    foreach ($old_details as $oldKey => $old) {
                        if ($old->sku_barang === $det->sku && $old->size === $det->size) {
                            $detail = $old;
                            unset($old_details[$oldKey]);
                        }
                    }
                    $detail->jumlah = $det->jumlah;
                    $detail->size = $det->size;
                    $detail->harga_satuan = $det->harga_satuan;
                    $total += $det->harga_satuan * $det->jumlah;
                    if($detail->save()) {
                        $stock = new Stock();
                        $stock->sku_barang = $detail->sku_barang;
                        $stock->id_detail = $detail->id_detail;
                        if(($st = Stock::find()->andWhere(['id_detail'=> $detail->id_detail])->one()) !== null) {
                            $stock = $st;
                            if(($ba = Barang::findOne($detail->sku_barang)) !== null) {
                                $ba->stock = $ba->stock - $st->stock_awal;
                                $ba->save();
                            }
                        }
                        $stock->stock_awal = $detail->jumlah;
                        $stock->stock_real = $detail->jumlah;
                        $stock->size = $detail->size;
                        $stock->save();
                        if(($ba = Barang::findOne($detail->sku_barang)) !== null) {
                            $ba->stock = $ba->stock + $detail->jumlah;
                            $ba->save();
                        }
                    }
                }
                foreach ($old_details as $oldKey => $old) {
                    $old->delete();
                }
                $model->total_harga = $total;
                $model->save(false);
                return $this->redirect(['view', 'id' => $model->no_pembelian]);
            }
        }

        $details = DetailPembelian::find()->andWhere([ 'no_pembelian' => $id])->asArray()->all();
        foreach ($details as $key => $det) {
            // nama_barang  satuan barang_expired
            $nama_barang = '';
            if (($barang = Barang::findOne($det['sku_barang'])) !== null) {
                $nama_barang = $barang->nama;
            }
            $details[$key]['nama'] = $nama_barang;
            $details[$key]['sku'] = $det['sku_barang'];
        }
        
        $model->tanggal_pembelian = date('d-m-Y H:i', strtotime($model->tanggal_pembelian));

        return $this->render('update', [
            'model' => $model,
            'details' => json_encode($details),
            'barangs' => Barang::find()
                ->where(['aktif' => 1])->all(),
            'arr_barangs' => json_encode(Barang::find()
                    ->where(['aktif' => 1])->asArray()->all()),
        ]);
    }

    /**
     * Deletes an existing Pembelian model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Pembelian model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Pembelian the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Pembelian::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

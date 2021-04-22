<?php

namespace frontend\controllers;

define("_DEBUG", false); //ISI TRUE ATAU FALSE

date_default_timezone_set("Asia/Jakarta");

use common\models\Barang;
use common\models\DetailPenjualan;
use common\models\DetailPenjualanSearch;
use common\models\Penjualan;
use common\models\PenjualanSearch;
use common\models\Stock;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * PenjualanController implements the CRUD actions for Penjualan model.
 */
class PenjualanController extends Controller
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
     * Lists all Penjualan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PenjualanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => new Penjualan(),
        ]);
    }

    /**
     * Displays a single Penjualan model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $searchModel = new DetailPenjualanSearch();
        $searchModel->no_penjualan = $id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Penjualan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */

    private function getNo($not = '', $add = 1)
    {
        $last = Penjualan::find();
        if ($not !== '') {
            $last->andWhere(['<>', 'no_penjualan', $not]);
        }
        $last = $last->orderBy(['no_penjualan' => SORT_DESC])->one();
        $no = 'JVS0000001';
        if ($last !== null) {
            $ln = $last->no_penjualan;
            if (strpos($ln, 'JVS') !== false) {
                $ln = str_replace("JVS", "", $ln);
            }
            $ln = (int) $ln + $add;
            $ln = $ln . '';
            while (strlen($ln) < 7) {
                $ln = '0' . $ln;
            }
            $no = 'JVS' . $ln;
        }
        if (Penjualan::findOne($no) !== null) {
            return $this->getNo($no, $add + 1);
        } else {
            return $no;
        }
    }

    private function gender($jenkel)
    {
        switch ($jenkel) {
            case 'Laki-laki':
                return 'M';
            case 'Perempuan':
                return 'F';
        }
    }

    private function pekerjaan($data, $peker)
    {
        $c = 1;
        foreach ($data as $p) {
            if (trim($p, ' ') === trim($peker, ' ')) {
                return $c;
            }
            $c += 1;
        }
        return 0;
    }

    private function knn($model)
    {
        if (_DEBUG) {
            print_r(' Nilai Pekerjaan <br><br>');
            $c = 1;
            foreach ($model->kerjalist() as $key => $kerja) {
                print_r($kerja . ' = ' . $c . '<br>');
                $c += 1;
            }
            print_r('<br><br>');
        }
      
        //ambil data riwayat penjualan yang gender sama atau gender universal
        $pens = [];
        foreach (Penjualan::find()->all() as $pen) {
            $dets = DetailPenjualan::find()->andWhere(['no_penjualan' => $pen->no_penjualan])->all();
            foreach ($dets as $det) {
                if ($det->skuBarang->gender === 'U' || $this->gender($pen->jenis_kelamin) === $det->skuBarang->gender) {
                    $pen->detail = $det;
                    break;
                }
            }
            if ($pen->detail !== null) {
                $pens[] = $pen;
            }
        }

        //cari jarak umur dan pekerjaan dengan rumus knn
        foreach ($pens as $key => $pen) {
            $pen->jarak =
            pow($pen->umur - $model->umur, 2) +
            pow($this->pekerjaan($model->kerjalist(), $pen->pekerjaan) - $this->pekerjaan($model->kerjalist(), $model->pekerjaan), 2);
            if (_DEBUG) {
                print_r(' Data Sampel Penjualan ' . $pen->detail->no_penjualan . '<br>');
                print_r(' DATA PENJUALAN LAMA - DATA PENJUALAN BARU DATANG <br>');
                print_r(' Umur : Pangkat 2 (' . $pen->umur . '-' . $model->umur . ') = ' . pow($pen->umur - $model->umur, 2) . '<br>');
                print_r(' Pekerjaan : ' . $pen->pekerjaan . ' -' . $model->pekerjaan . '<br>');
                print_r(' Pekerjaan : Pangkat 2 (' . $this->pekerjaan($model->kerjalist(), $pen->pekerjaan) . '-' . $this->pekerjaan($model->kerjalist(), $model->pekerjaan) . ') = '
                    . pow($this->pekerjaan($model->kerjalist(), $pen->pekerjaan) - $this->pekerjaan($model->kerjalist(), $model->pekerjaan), 2) . '<br>');
                print_r(' Akar (' . $pen->jarak . ')');
                print_r(' =  (' . sqrt($pen->jarak) . ')<br><br>');
            }
            $pen->jarak = sqrt($pen->jarak);
        }

        //bubble sort
        for ($i = 0; $i < sizeof($pens); $i++) {
            for ($e = 0; $e < sizeof($pens); $e++) {
                if ($pens[$i]->jarak < $pens[$e]->jarak) {
                    $temp = $pens[$i];
                    $pens[$i] = $pens[$e];
                    $pens[$e] = $temp;
                }
            }
        }

        if (_DEBUG) {
            die(sizeof($pens));
        }

        //inisialisasi data barang 
        $data = [];
        foreach ($pens as $p) {
            $f = false;
            foreach ($data as $d) {
                if ($d->sku === $p->detail->sku_barang) {
                    $f = true;
                    break;
                }
            }
            if (!$f) {
                $data[] = Barang::findOne($p->detail->sku_barang);
            }

        }
        return $data;
    }

    public function actionCreate()
    {
        $model = new Penjualan();
        $model->total_harga = 0;
        $model->dibuat_oleh = Yii::$app->user->identity->username;
        $model->no_penjualan = $this->getNo();
        $model->tanggal_penjualan = date('d-m-Y H:i');
        if ($model->load(Yii::$app->request->post())) {
            $model->total_harga = str_replace(".", "", $model->total_harga);
            $model->tanggal_penjualan = date('Y-m-d H:i:s', strtotime($model->tanggal_penjualan));
            if ($model->save(false)) {
                $total = 0;
                foreach (json_decode($model->detail) as $det) {
                    $detail = new DetailPenjualan();
                    $detail->no_penjualan = $model->no_penjualan;
                    $detail->sku_barang = $det->sku;
                    $detail->jumlah = $det->jumlah;
                    $detail->size = $det->size;
                    $detail->harga_satuan = $det->harga_satuan;
                    $total += $det->harga_satuan * $det->jumlah;
                    if ($detail->save(false)) {
                        $stocks = Stock::find()->andWhere(['sku_barang' => $det->sku])->andWhere(['size' => $detail->size])->andWhere(['>', 'stock_real', 0])->all();
                        $jum = $detail->jumlah;
                        foreach ($stocks as $stock) {
                            if ($stock->stock_real > $jum) {
                                $stock->stock_real = $stock->stock_real - $jum;
                                $stock->save();
                                break;
                            } else {
                                $jum = $jum - $stock->stock_real;
                                $stock->stock_real = 0;
                                $stock->save();
                            }
                        }
                        if (($ba = Barang::findOne($detail->sku_barang)) !== null) {
                            $ba->stock = $ba->stock - $detail->jumlah;
                            $ba->save();
                        }
                    }
                }
                $model->total_harga = $total;
                $model->save(false);
                return $this->redirect(['penjualan/index']);
            }            
        }

        return $this->render('create', [
            'model' => $model,
            'details' => json_encode([]),
            'barangs' => Barang::find()
                ->where(['aktif' => 1])->all(),
            'arr_barangs' => json_encode(Barang::find()
                    ->where(['aktif' => 1])->asArray()->all()),
        ]);
    }

    public function actionStock()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $data = [];

        if (isset($_POST['sku'])) {
            $sku = $_POST['sku'];
            $stocks = Stock::find()->andWhere(['sku_barang' => $sku])->andWhere(['>', 'stock_real', 0])->all();
            foreach ($stocks as $stock) {
                $f = false;
                foreach ($data as $k => $d) {
                    if ($d['size'] == $stock->size) {
                        $data[$k]['stock'] = $data[$k]['stock'] + $stock->size;
                        $f = true;
                        break;
                    }
                }
                if (!$f) {
                    $data[] = [
                        'sku' => $stock->sku_barang,
                        'size' => $stock->size,
                        'stock' => $stock->stock_real,
                    ];
                }
            }
        }
        return $data;
    }
    /**
     * Updates an existing Penjualan model.
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
            $model->tanggal_penjualan = date('Y-m-d H:i:s', strtotime($model->tanggal_penjualan));
            if ($model->save(false)) {
                $total = 0;
                $old_details = DetailPenjualan::find()->andWhere(['no_penjualan' => $id])->all();
                foreach (json_decode($model->detail) as $det) {
                    $detail = new DetailPenjualan();
                    $detail->no_penjualan = $model->no_penjualan;
                    $detail->sku_barang = $det->sku;
                    $old_jum = 0;
                    foreach ($old_details as $oldKey => $old) {
                        if ($old->sku_barang === $det->sku && $old->size === $det->size) {
                            $detail = $old;
                            $old_jum = $old->jumlah;
                            unset($old_details[$oldKey]);
                        }
                    }
                    $detail->jumlah = $det->jumlah;
                    $detail->size = $det->size;
                    $detail->harga_satuan = $det->harga_satuan;
                    $total += $det->harga_satuan * $det->jumlah;
                    if ($detail->save(false)) {
                        $stocks = Stock::find()->andWhere(['sku_barang' => $det->sku])->andWhere(['size' => $detail->size])->andWhere(['>', 'stock_real', 0])->all();
                        $jum = $detail->jumlah;
                        foreach ($stocks as $stock) {
                            if (($stock->stock_real + $old_jum) > $jum) {
                                $stock->stock_real = ($stock->stock_real + $old_jum) - $jum;
                                $stock->save();
                                break;
                            } else {
                                $jum = $jum - $stock->stock_real;
                                $stock->stock_real = 0;
                                $stock->save();
                            }
                        }
                        if (($ba = Barang::findOne($detail->sku_barang)) !== null) {
                            $ba->stock = ($ba->stock + $old_jum) - $detail->jumlah;
                            $ba->save();
                        }
                    }
                }
                foreach ($old_details as $oldKey => $old) {
                    $old->delete();
                }
                $model->total_harga = $total;
                $model->save(false);
                return $this->redirect(['penjualan/index']);
            }
        }

        $details = DetailPenjualan::find()->andWhere(['no_penjualan' => $id])->asArray()->all();
        foreach ($details as $key => $det) {
            // nama_barang  satuan barang_expired
            $nama_barang = '';
            if (($barang = Barang::findOne($det['sku_barang'])) !== null) {
                $nama_barang = $barang->nama;
            }
            $details[$key]['nama'] = $nama_barang;
            $details[$key]['sku'] = $det['sku_barang'];
        }

        $model->tanggal_penjualan = date('d-m-Y H:i', strtotime($model->tanggal_penjualan));

        return $this->render('update', [
            'model' => $model,
            'rekom' => $this->knn($model),
            'details' => json_encode($details),
            'barangs' => Barang::find()
                ->where(['aktif' => 1])->all(),
            'arr_barangs' => json_encode(Barang::find()
                    ->where(['aktif' => 1])->asArray()->all()),
        ]);
    }

    /**
     * Deletes an existing Penjualan model.
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
     * Finds the Penjualan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Penjualan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Penjualan::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

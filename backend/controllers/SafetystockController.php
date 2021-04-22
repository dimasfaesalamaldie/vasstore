<?php

namespace backend\controllers;

use common\models\Barang;
use common\models\BarangSearch;
use common\models\Penjualan;
use common\models\SafetyStock;
use common\models\SafetyStockSearch;
use common\models\Stock;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use \DateTime;

/**
 * SafetystockController implements the CRUD actions for SafetyStock model.
 */
class SafetystockController extends Controller
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
    
    private function getMax($barang, $size)
    {
        $max = 0;
        $start = DateTime::createFromFormat('Y-m-d', date('Y-m-d', strtotime("-1 year", time())));
        for ($i = 0; $i < 12; $i++) {
            $temp = 0;
            foreach (Penjualan::find()->where(['between', 'tanggal_penjualan', $start->format('Y-m-d'), $start->format('Y-m-t')])->all() as $pen) {
                foreach ($pen->detailPenjualans as $det) {
                    if ($det->sku_barang === $barang->sku && $det->size == $size) {
                        $temp += $det->jumlah;
                    }
                }
            }
            $max = $max > $temp ? $max : $temp;
            $start->modify('+1 month');
        }
        return $max;
    }

    private function getRerata($barang, $size)
    {
        $count = 0;
        $start = DateTime::createFromFormat('Y-m-d', date('Y-m-d', strtotime("-1 year", time())));
        for ($i = 0; $i < 12; $i++) {
            foreach (Penjualan::find()->where(['between', 'tanggal_penjualan', $start->format('Y-m-d'), $start->format('Y-m-t')])->all() as $pen) {
                foreach ($pen->detailPenjualans as $det) {
                    if ($det->sku_barang === $barang->sku && $det->size == $size) {
                        $count += $det->jumlah;
                    }
                }
            }
            $start->modify('+1 month');
        }
        return (float) $count / 12;
    }

    private function createSafetyStock($barang, $size, $stock)
    {
        $sf = SafetyStock::find()->andWhere(['sku_barang' => $barang->sku, 'size' => $size])->one();
        if ($sf === null) {
            $sf = new SafetyStock();
            $sf->sku_barang = $barang->sku;
            $sf->size = $size;
        }
        $sf->max = $this->getMax($barang, $size);
        $sf->rerata = $this->getRerata($barang, $size);
        $sf->leadtime = $barang->leadtime;
        $sf->stock = $stock;
        $sf->safety_stock = (int) (($sf->max - $sf->rerata) * $barang->leadtime);
        if ($stock == 0) {
            $sf->status = 2;
        } else {
            $sf->status = $sf->stock >= $sf->safety_stock ? 1 : 2;
        }
        $sf->save();
    }

    private function syncSafetyStock()
    {
        $barang = null;
        $size = null;
        $stock = 0;
        foreach (Stock::find()->orderBy(['sku_barang' => SORT_ASC, 'size' => SORT_ASC])->all() as $st) {
            if ($barang === null) {
                $barang = Barang::findOne($st->sku_barang);
                $size = $st->size;
                $stock = 0;
                $barang->stock = 0;
            }
            $created = false;
            if ($size != $st->size) {
                $barang->stock += $stock;
                $barang->save();
                $this->createSafetyStock($barang, $size, $stock);
                $created = true;
                $size = $st->size;
                $stock = 0;
            }
            if ($barang->sku !== $st->sku_barang) {
                if (!$created) {
                    $barang->stock += $stock;
                    $barang->save();
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
     * Lists all SafetyStock models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->syncSafetyStock();
        $searchModel = new BarangSearch();
        $searchModel->aktif = 1;
        $searchModel->sort = 1;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SafetyStock model.
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

    /**
     * Creates a new SafetyStock model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SafetyStock();

        if ($model->load(Yii::$app->request->post())) {
            $model->aktif = 0;
            if (($barang = Barang::findOne($model->sku_barang)) !== null) {
                $model->aktif = $barang->aktif;
            }
            if ($model->save()) {
                return $this->redirect(['index']);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing SafetyStock model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->aktif = 0;
            if (($barang = Barang::findOne($model->sku_barang)) !== null) {
                $model->aktif = $barang->aktif;
            }
            if ($model->save()) {
                return $this->redirect(['index']);
            }

        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing SafetyStock model.
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
     * Finds the SafetyStock model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SafetyStock the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SafetyStock::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

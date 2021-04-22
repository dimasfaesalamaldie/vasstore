<?php

namespace backend\controllers;

use backend\models\DataPrint;
use backend\models\PrintData;
use common\models\DetailPenjualanSearch;
use common\models\Penjualan; //
use common\models\PenjualanSearch;
use kartik\mpdf\Pdf;
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
        $dataPen = new PrintData();
        $searchModelPen = new PenjualanSearch();
        $dataProviderPen = $searchModelPen->search(Yii::$app->request->queryParams);
        $dataPen->search = $searchModelPen;

        $dataBarang = new DataPrint();
        $searchModelBarang = new DetailPenjualanSearch();
        $dataProviderBarang = $searchModelBarang->search2(Yii::$app->request->queryParams);

        $dataBarang->search = $searchModelPen;
        //print_r(Yii::$app->request);die();
        if ($dataPen->load(Yii::$app->request->post())) {
            // get your HTML raw content without any layouts or scripts
            $searchModelPen->all = true;
            $dataProviderPen = $searchModelPen->search(Yii::$app->request->queryParams);
            $content = $this->renderPartial('_report_penjualan', [
                'searchModel' => $searchModelPen,
                'dataProvider' => $dataProviderPen,
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
                'destination' => Pdf::DEST_BROWSER,
                // your html content input
                'content' => $content,
                // format content from your own css file if needed or use the
                // enhanced bootstrap css built by Krajee for mPDF formatting
                'cssFile' => '@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css',
                // any css to be embedded if required
                'cssInline' => '.kv-heading-1{font-size:18px}',
                // set mPDF properties on the fly
                'options' => ['title' => 'Krajee Report Title'],
                // call mPDF methods on the fly
                'methods' => [
                    'SetHeader' => ['Data Penjualan Vaststore'],
                    'SetFooter' => ['{PAGENO}'],
                ],
            ]);

            // return the pdf output as per the destination setting
            return $pdf->render();
        }

        if ($dataBarang->load(Yii::$app->request->post())) {
            // get your HTML raw content without any layouts or scripts
            $searchModelBarang->all = true;
            $dataProviderBarang = $searchModelBarang->search2(Yii::$app->request->queryParams);
            $content = $this->renderPartial('_report_barang', [
                'searchModel' => $searchModelBarang,
                'dataProvider' => $dataProviderBarang,
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
                'destination' => Pdf::DEST_BROWSER,
                // your html content input
                'content' => $content,
                // format content from your own css file if needed or use the
                // enhanced bootstrap css built by Krajee for mPDF formatting
                'cssFile' => '@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css',
                // any css to be embedded if required
                'cssInline' => '.kv-heading-1{font-size:18px}',
                // set mPDF properties on the fly
                'options' => ['title' => 'Krajee Report Title'],
                // call mPDF methods on the fly
                'methods' => [
                    'SetHeader' => ['Data Penjualan Barang'],
                    'SetFooter' => ['{PAGENO}'],
                ],
            ]);

            // return the pdf output as per the destination setting
            return $pdf->render();
        }

        $dataProviderPen->sort->sortParam = 'unsafe-sort';
        
        
        
        $dataProviderBarang->sort->sortParam = 'all-sort';

        return $this->render('index', [
            'model' => new Penjualan(),
            'dataPen' => $dataPen,
            'searchModelPen' => $searchModelPen,
            'dataProviderPen' => $dataProviderPen,

            'dataBarang' => $dataBarang,
            'searchModelBarang' => $searchModelBarang,
            'dataProviderBarang' => $dataProviderBarang,
        ]);
    }
    
    public function actionBarang()
    {
        $dataBarang = new DataPrint();
        $searchModelBarang = new DetailPenjualanSearch();
        $dataProviderBarang = $searchModelBarang->search2(Yii::$app->request->queryParams);

        $dataBarang->search = $searchModelBarang;
        if ($dataBarang->load(Yii::$app->request->post())) {
            // get your HTML raw content without any layouts or scripts
            $searchModelBarang->all = true;
            $dataProviderBarang = $searchModelBarang->search2(Yii::$app->request->queryParams);
            $content = $this->renderPartial('_report_barang', [
                'searchModel' => $searchModelBarang,
                'dataProvider' => $dataProviderBarang,
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
                'destination' => Pdf::DEST_BROWSER,
                // your html content input
                'content' => $content,
                // format content from your own css file if needed or use the
                // enhanced bootstrap css built by Krajee for mPDF formatting
                'cssFile' => '@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css',
                // any css to be embedded if required
                'cssInline' => '.kv-heading-1{font-size:18px}',
                // set mPDF properties on the fly
                'options' => ['title' => 'Krajee Report Title'],
                // call mPDF methods on the fly
                'methods' => [
                    'SetHeader' => ['Data Penjualan Barang'],
                    'SetFooter' => ['{PAGENO}'],
                ],
            ]);

            // return the pdf output as per the destination setting
            return $pdf->render();
        }

        return $this->render('index_bar', [

            'data' => $dataBarang,
            'searchModel' => $searchModelBarang,
            'dataProvider' => $dataProviderBarang,
        ]);
    }
    
    public function actionJual()
    {
        $dataPen = new PrintData();
        $searchModelPen = new PenjualanSearch();
        $dataProviderPen = $searchModelPen->search(Yii::$app->request->queryParams);
        $dataPen->search = $searchModelPen;

        if ($dataPen->load(Yii::$app->request->post())) {
            // get your HTML raw content without any layouts or scripts
            $searchModelPen->all = true;
            $dataProviderPen = $searchModelPen->search(Yii::$app->request->queryParams);
            $content = $this->renderPartial('_report_penjualan', [
                'searchModel' => $searchModelPen,
                'dataProvider' => $dataProviderPen,
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
                'destination' => Pdf::DEST_BROWSER,
                // your html content input
                'content' => $content,
                // format content from your own css file if needed or use the
                // enhanced bootstrap css built by Krajee for mPDF formatting
                'cssFile' => '@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css',
                // any css to be embedded if required
                'cssInline' => '.kv-heading-1{font-size:18px}',
                // set mPDF properties on the fly
                'options' => ['title' => 'Krajee Report Title'],
                // call mPDF methods on the fly
                'methods' => [
                    'SetHeader' => ['Data Penjualan Vaststore'],
                    'SetFooter' => ['{PAGENO}'],
                ],
            ]);

            // return the pdf output as per the destination setting
            return $pdf->render();
        }

        return $this->render('index_jual', [
            'model' => new Penjualan(),
            'data' => $dataPen,
            'searchModel' => $searchModelPen,
            'dataProvider' => $dataProviderPen,
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
    public function actionCreate()
    {
        $model = new Penjualan();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->no_penjualan]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->no_penjualan]);
        }

        return $this->render('update', [
            'model' => $model,
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

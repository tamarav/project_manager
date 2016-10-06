<?php

namespace app\controllers;

use Yii;
use app\models\Ucesnik;
use app\models\User;
use app\controllers\UserController;
use app\models\UcesnikSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UcesnikController implements the CRUD actions for Ucesnik model.
 */
class UcesnikController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'view', 'create', 'update','delete','pdf'],
                        'roles' => ['@']
                    ],
                    [
                        'allow' => false
                    ]
                ]
            ]
        ];
    }

    /**
     * Lists all Ucesnik models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UcesnikSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Ucesnik model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $providerAktivnost = new \yii\data\ArrayDataProvider([
            'allModels' => $model->aktivnosts,
        ]);
        $providerProjekat = new \yii\data\ArrayDataProvider([
            'allModels' => $model->projekats,
        ]);
        $providerRadiNaProjektu = new \yii\data\ArrayDataProvider([
            'allModels' => $model->radiNaProjektus,
        ]);
        $providerRadiNaZadatku = new \yii\data\ArrayDataProvider([
            'allModels' => $model->radiNaZadatkus,
        ]);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'providerAktivnost' => $providerAktivnost,
            'providerProjekat' => $providerProjekat,
            'providerRadiNaProjektu' => $providerRadiNaProjektu,
            'providerRadiNaZadatku' => $providerRadiNaZadatku,
        ]);
    }

    /**
     * Creates a new Ucesnik model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {        $model = new Ucesnik();
        if ($model->load(Yii::$app->request->post())) {
					$user = new User();
					$user = \app\models\User::findOne($model->user_id);
					$model->setAttribute('vrsta_ucesnika',$user->getRoleName());
				if ($model->save()){
					$user->status=10;
					$user->save();
					return $this->redirect(['view', 'id' => $model->id]);
				}
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Ucesnik model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Ucesnik model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->deleteWithRelated();

        return $this->redirect(['index']);
    }
    
    /**
     * 
     * for export pdf at actionView
     *  
     * @param type $id
     * @return type
     */
    public function actionPdf($id) {
        $model = $this->findModel($id);
        $providerAktivnost = new \yii\data\ArrayDataProvider([
            'allModels' => $model->aktivnosts,
        ]);
        $providerProjekat = new \yii\data\ArrayDataProvider([
            'allModels' => $model->projekats,
        ]);
        $providerRadiNaProjektu = new \yii\data\ArrayDataProvider([
            'allModels' => $model->radiNaProjektus,
        ]);
        $providerRadiNaZadatku = new \yii\data\ArrayDataProvider([
            'allModels' => $model->radiNaZadatkus,
        ]);

        $content = $this->renderAjax('_pdf', [
            'model' => $model,
            'providerAktivnost' => $providerAktivnost,
            'providerProjekat' => $providerProjekat,
            'providerRadiNaProjektu' => $providerRadiNaProjektu,
            'providerRadiNaZadatku' => $providerRadiNaZadatku,
        ]);

        $pdf = new \kartik\mpdf\Pdf([
            'mode' => \kartik\mpdf\Pdf::MODE_CORE,
            'format' => \kartik\mpdf\Pdf::FORMAT_A4,
            'orientation' => \kartik\mpdf\Pdf::ORIENT_PORTRAIT,
            'destination' => \kartik\mpdf\Pdf::DEST_BROWSER,
            'content' => $content,
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
            'cssInline' => '.kv-heading-1{font-size:18px}',
            'options' => ['title' => \Yii::$app->name],
            'methods' => [
                'SetHeader' => [\Yii::$app->name],
                'SetFooter' => ['{PAGENO}'],
            ]
        ]);

        return $pdf->render();
    }
    
    /**
     * Finds the Ucesnik model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Ucesnik the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Ucesnik::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    /**
    * Action to load a tabular form grid
    * for Aktivnost
    * @author Yohanes Candrajaya <moo.tensai@gmail.com>
    * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
    *
    * @return mixed
    */
    public function actionAddAktivnost()
    {
        if (Yii::$app->request->isAjax) {
            $row = Yii::$app->request->post('Aktivnost');
            if((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('action') == 'load' && empty($row)) || Yii::$app->request->post('action') == 'add')
                $row[] = [];
            return $this->renderAjax('_formAktivnost', ['row' => $row]);
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    /**
    * Action to load a tabular form grid
    * for Projekat
    * @author Yohanes Candrajaya <moo.tensai@gmail.com>
    * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
    *
    * @return mixed
    */
    public function actionAddProjekat()
    {
        if (Yii::$app->request->isAjax) {
            $row = Yii::$app->request->post('Projekat');
            if((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('action') == 'load' && empty($row)) || Yii::$app->request->post('action') == 'add')
                $row[] = [];
            return $this->renderAjax('_formProjekat', ['row' => $row]);
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    /**
    * Action to load a tabular form grid
    * for RadiNaProjektu
    * @author Yohanes Candrajaya <moo.tensai@gmail.com>
    * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
    *
    * @return mixed
    */
    public function actionAddRadiNaProjektu()
    {
        if (Yii::$app->request->isAjax) {
            $row = Yii::$app->request->post('RadiNaProjektu');
            if((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('action') == 'load' && empty($row)) || Yii::$app->request->post('action') == 'add')
                $row[] = [];
            return $this->renderAjax('_formRadiNaProjektu', ['row' => $row]);
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    /**
    * Action to load a tabular form grid
    * for RadiNaZadatku
    * @author Yohanes Candrajaya <moo.tensai@gmail.com>
    * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
    *
    * @return mixed
    */
    public function actionAddRadiNaZadatku()
    {
        if (Yii::$app->request->isAjax) {
            $row = Yii::$app->request->post('RadiNaZadatku');
            if((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('action') == 'load' && empty($row)) || Yii::$app->request->post('action') == 'add')
                $row[] = [];
            return $this->renderAjax('_formRadiNaZadatku', ['row' => $row]);
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

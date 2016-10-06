<?php

namespace app\controllers;

use Yii;
use yii\data\ArrayDataProvider; 
use yii\data\ActiveDataProvider;
use yii\data\SqlDataProvider;
use app\models\Aktivnost;
use app\models\AktivnostSearch;
use app\models\User;
use app\models\Ucesnik;
use app\models\Projekat;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


/**
 * AktivnostController implements the CRUD actions for Aktivnost model.
 */
class AktivnostController extends Controller
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
						'actions' => ['index','pdf'],
						'roles' => ['@']
					],
					[
						'allow' => true,
						'actions' => ['index', 'create', 'view', 'pdf', 'delete','update'],
						'roles' => ['admin']
					],
					[
						'allow' => true,
						'actions' => ['index', 'create', 'view', 'pdf'],
						'roles' => ['nadzor']
					],
					[
						'allow' => true,
						'actions' => ['index', 'create', 'view', 'pdf'],
						'roles' => ['sef']
					],
					[
						'allow' => false,
						'actions' => ['index', 'create', 'view', 'pdf','update'],
						'roles' => ['radnik']
					],
					
                    [
                        'allow' => false
                    ]
                ]
            ]
        ];
    }
    /**
     * Lists all Aktivnost models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AktivnostSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		
		
		 if(User::isAdmin(Yii::$app->user->id) || User::isCreator(Yii::$app->user->id)){
			return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
		 }
		else if(User::isSef(Yii::$app->user->id)){
			$ucesnikId = Ucesnik::vratiIdUcesnika(Yii::$app->user->id);
			$projekti = \app\models\Projekat::find()->where(['sef_na_projektu'=>$ucesnikId])->all();
			$niz=[];
			foreach($projekti as $projekat){
				array_push($niz,$projekat->id);
			}
			$zadaci = [];
			foreach($niz as $nizz){
				$zadatak = \app\models\Zadatak::find()->where(['projekat_id'=>$nizz])->all();
				foreach($zadatak as $zad){
					array_push($zadaci,$zad->id);
				}
			}
			$query = Aktivnost::find()->where(['zadatak_id'=>$zadaci]);
			$dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
		}else if(User::isNadzor(Yii::$app->user->id)){
			$ucesnikId = Ucesnik::vratiIdUcesnika(Yii::$app->user->id);
			$projekti = \app\models\Projekat::find()->where(['nadzor'=>$ucesnikId])->all();
			$niz=[];
			foreach($projekti as $projekat){
				array_push($niz,$projekat->id);
			}
			$zadaci = [];
			foreach($niz as $nizz){
				$zadatak = \app\models\Zadatak::find()->where(['projekat_id'=>$nizz])->all();
				foreach($zadatak as $zad){
					array_push($zadaci,$zad->id);
				}
	
			}
			$query = Aktivnost::find()->where(['zadatak_id'=>$zadaci]);
			$dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);		
		}else if(User::isRadnik(Yii::$app->user->id)){
			$ucesnikId = Ucesnik::vratiIdUcesnika(Yii::$app->user->id);
			$query = Aktivnost::find()->where(['ucesnik_id'=>$ucesnikId]);
			$dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);		
		
		}
				return $this->render('index', [
				'searchModel' => $searchModel,
				'dataProvider' => $dataProvider,
        ]);
		}


    /**
     * Displays a single Aktivnost model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $providerPrihod = new \yii\data\ArrayDataProvider([
            'allModels' => $model->prihods,
        ]);
        $providerRashod = new \yii\data\ArrayDataProvider([
            'allModels' => $model->rashods,
        ]);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'providerPrihod' => $providerPrihod,
            'providerRashod' => $providerRashod,
        ]);
    }

    /**
     * Creates a new Aktivnost model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Aktivnost();

        if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Aktivnost model.
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
     * Deletes an existing Aktivnost model.
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
        $providerPrihod = new \yii\data\ArrayDataProvider([
            'allModels' => $model->prihods,
        ]);
        $providerRashod = new \yii\data\ArrayDataProvider([
            'allModels' => $model->rashods,
        ]);

        $content = $this->renderAjax('_pdf', [
            'model' => $model,
            'providerPrihod' => $providerPrihod,
            'providerRashod' => $providerRashod,
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
     * Finds the Aktivnost model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Aktivnost the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Aktivnost::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    /**
    * Action to load a tabular form grid
    * for Prihod
    * @author Yohanes Candrajaya <moo.tensai@gmail.com>
    * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
    *
    * @return mixed
    */
    public function actionAddPrihod()
    {
        if (Yii::$app->request->isAjax) {
            $row = Yii::$app->request->post('Prihod');
            if((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('action') == 'load' && empty($row)) || Yii::$app->request->post('action') == 'add')
                $row[] = [];
            return $this->renderAjax('_formPrihod', ['row' => $row]);
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    /**
    * Action to load a tabular form grid
    * for Rashod
    * @author Yohanes Candrajaya <moo.tensai@gmail.com>
    * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
    *
    * @return mixed
    */
    public function actionAddRashod()
    {
        if (Yii::$app->request->isAjax) {
            $row = Yii::$app->request->post('Rashod');
            if((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('action') == 'load' && empty($row)) || Yii::$app->request->post('action') == 'add')
                $row[] = [];
            return $this->renderAjax('_formRashod', ['row' => $row]);
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

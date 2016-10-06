<?php
namespace app\controllers;

use Yii;
use app\models\Projekat;
use app\models\User;
use app\models\ProjekatSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProjekatController implements the CRUD actions for Projekat model.
 */
	class ProjekatController extends Controller
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
                        'actions' => ['index'],
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['view','pdf'],
						'roles' => ['sef'],
						'matchCallback' => function ($rule, $action) {
                            $projekat = \app\models\Projekat::findOne(Yii::$app->request->get('id'));
							return $projekat->sef->user_id == Yii::$app->user->id;
						}
                    ],
					[
                        'allow' => true,
                        'actions' => ['view'],
                        'roles' => ['nadzor'],

						
                    ],
					[
                        'allow' => true,
                        'actions' => ['create','view','update','delete','pdf'],
                        'roles' => ['admin'],
                    ],
                    [
                        'allow' => false
                    ]
                ]
            ]
        ];
    }
		/**
		 * Lists all Projekat models.
		 * @return mixed
		 */
		
    /**
     * Lists all Projekat models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProjekatSearch();
		$filter=Yii::$app->request->queryParams;
		$dataProvider = $searchModel->search($filter);
		if(User::isAdmin(Yii::$app->user->id) || User::isCreator(Yii::$app->user->id)){
			return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
		}
		else if(User::isNadzor(Yii::$app->user->id)){
			$filter["ProjekatSearch"]["nadzor"]= \app\models\Ucesnik::find()->where(['user_id'=>Yii::$app->user->id])->one()->id;
			$dataProvider = $searchModel->search($filter);

			return $this->render('index', [
				'searchModel' => $searchModel,
				'dataProvider' => $dataProvider,
        ]);
		}
		else if(User::isSef(Yii::$app->user->id)){
		$filter["ProjekatSearch"]["sef_na_projektu"]= \app\models\Ucesnik::find()->where(['user_id'=>Yii::$app->user->id])->one()->id;
        $dataProvider = $searchModel->search($filter);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
		}
		else if(User::isRadnik(Yii::$app->user->id)){
			return $this->redirect(['/aktivnost/index']);
		}
		else{
			echo "Vi nemate nikakva prava za pristup!!!";
		}
    }
		/**
		 * Displays a single Projekat model.
		 * @param integer $id
		 * @return mixed
		 */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $providerRadiNaProjektu = new \yii\data\ArrayDataProvider([
            'allModels' => $model->radiNaProjektus,
        ]);
        $providerZadatak = new \yii\data\ArrayDataProvider([
            'allModels' => $model->zadataks,
        ]);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'providerRadiNaProjektu' => $providerRadiNaProjektu,
            'providerZadatak' => $providerZadatak,
        ]);
    }
		/**
		 * Creates a new Projekat model.
		 * If creation is successful, the browser will be redirected to the 'view' page.
		 * @return mixed
		 */
		public function actionCreate()
		{
			$model = new Projekat();

			if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
				return $this->redirect(['view', 'id' => $model->id]);
			} else {
				return $this->render('create', [
					'model' => $model,
				]);
			}
		}

		/**
		 * Updates an existing Projekat model.
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
		 * Deletes an existing Projekat model.
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
			$providerRadiNaProjektu = new \yii\data\ArrayDataProvider([
				'allModels' => $model->radiNaProjektus,
			]);
			$providerZadatak = new \yii\data\ArrayDataProvider([
				'allModels' => $model->zadataks,
			]);

			$content = $this->renderAjax('_pdf', [
				'model' => $model,
				'providerRadiNaProjektu' => $providerRadiNaProjektu,
				'providerZadatak' => $providerZadatak,
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
		 * Finds the Projekat model based on its primary key value.
		 * If the model is not found, a 404 HTTP exception will be thrown.
		 * @param integer $id
		 * @return Projekat the loaded model
		 * @throws NotFoundHttpException if the model cannot be found
		 */
		protected function findModel($id)
		{
			if (($model = Projekat::findOne($id)) !== null) {
				return $model;
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
		* for Zadatak
		* @author Yohanes Candrajaya <moo.tensai@gmail.com>
		* @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
		*
		* @return mixed
		*/
		public function actionAddZadatak()
		{
			if (Yii::$app->request->isAjax) {
				$row = Yii::$app->request->post('Zadatak');
				if((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('action') == 'load' && empty($row)) || Yii::$app->request->post('action') == 'add')
					$row[] = [];
				return $this->renderAjax('_formZadatak', ['row' => $row]);
			} else {
				throw new NotFoundHttpException('The requested page does not exist.');
			}
		}
	}

<?php
namespace app\controllers;

use app\models\User;
use app\models\Aktivnost;
use app\models\Ucesnik;
use app\models\LoginForm;
use app\models\Projekat;
use app\models\Zadatak;
use app\models\AccountActivation;
use app\models\PasswordResetRequestForm;
use app\models\ResetPasswordForm;
use app\models\SignupForm;
use app\models\ContactForm;
use yii\helpers\Html;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use Yii;

/**
 * Site controller.
 * It is responsible for displaying static pages, logging users in and out,
 * sign up and account activation, and password reset.
 */
class SiteController extends Controller
{
    /**
     * Returns a list of behaviors that this component should behave as.
     *
     * @return array
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Declares external actions for the controller.
     *
     * @return array
     */
    public function actions()
    {
        return [
		
			'servis' => ['class' => 'mongosoft\soapserver\Action'],
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

//------------------------------------------------------------------------------------------------//
// STATIC PAGES
//------------------------------------------------------------------------------------------------//

    /**
     * Displays the index (home) page.
     * Use it in case your home page contains static content.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Displays the about static page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Displays the contact static page and sends the contact email.
     *
     * @return string|\yii\web\Response
     */
    public function actionContact()
    {
        $model = new ContactForm();

        if (!$model->load(Yii::$app->request->post()) || !$model->validate()) {
            return $this->render('contact', ['model' => $model]);
        }

        if (!$model->sendEmail(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('error', Yii::t('app', 'There was some error while sending email.'));
            return $this->refresh();
        }

        Yii::$app->session->setFlash('success', Yii::t('app', 
            'Thank you for contacting us. We will respond to you as soon as possible.'));
        
        return $this->refresh();
    }

//------------------------------------------------------------------------------------------------//
// LOG IN / LOG OUT / PASSWORD RESET
//------------------------------------------------------------------------------------------------//

    /**
     * Logs in the user if his account is activated,
     * if not, displays appropriate message.
     *
     * @return string|\yii\web\Response
     */
    public function actionLogin()
    {
        // user is logged in, he doesn't need to login
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        // get setting value for 'Login With Email'
        $lwe = Yii::$app->params['lwe'];

        // if 'lwe' value is 'true' we instantiate LoginForm in 'lwe' scenario
        $model = $lwe ? new LoginForm(['scenario' => 'lwe']) : new LoginForm();

        // monitor login status
        $successfulLogin = true;

        // posting data or login has failed
        if (!$model->load(Yii::$app->request->post()) || !$model->login()) {
            $successfulLogin = false;
        }

        // if user's account is not activated, he will have to activate it first
        if ($model->status === User::STATUS_INACTIVE && $successfulLogin === false) {
            Yii::$app->session->setFlash('error', Yii::t('app', 
                'You have to activate your account first. Please check your email.'));
            return $this->refresh();
        } 

        // if user is not denied because he is not active, then his credentials are not good
        if ($successfulLogin === false) {
            return $this->render('login', ['model' => $model]);
        }

        // login was successful, let user go wherever he previously wanted
        return $this->goBack();
    }

    /**
     * Logs out the user.
     *
     * @return \yii\web\Response
     */
    public function actionLogout()
    {
		
        Yii::$app->user->logout();

        return $this->goHome();
    }

/*----------------*
 * PASSWORD RESET *
 *----------------*/

    /**
     * Sends email that contains link for password reset action.
     *
     * @return string|\yii\web\Response
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();

        if (!$model->load(Yii::$app->request->post()) || !$model->validate()) {
            return $this->render('requestPasswordResetToken', ['model' => $model]);
        }

        if (!$model->sendEmail()) {
            Yii::$app->session->setFlash('error', Yii::t('app', 
                'Sorry, we are unable to reset password for email provided.'));
            return $this->refresh();
        }

        Yii::$app->session->setFlash('success', Yii::t('app', 'Check your email for further instructions.'));

        return $this->goHome();
    }

    /**
     * Resets password.
     *
     * @param  string $token Password reset token.
     * @return string|\yii\web\Response
     *
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if (!$model->load(Yii::$app->request->post()) || !$model->validate() || !$model->resetPassword()) {
            return $this->render('resetPassword', ['model' => $model]);
        }

        Yii::$app->session->setFlash('success', Yii::t('app', 'New password was saved.'));

        return $this->goHome();      
    }    

//------------------------------------------------------------------------------------------------//
// SIGN UP / ACCOUNT ACTIVATION
//------------------------------------------------------------------------------------------------//

    /**
     * Signs up the user.
     * If user need to activate his account via email, we will display him
     * message with instructions and send him account activation email with link containing account activation token. 
     * If activation is not necessary, we will log him in right after sign up process is complete.
     * NOTE: You can decide whether or not activation is necessary, @see config/params.php
     *
     * @return string|\yii\web\Response
     */
    public function actionSignup()
    {  
        // get setting value for 'Registration Needs Activation'
        $rna = Yii::$app->params['rna'];

        // if 'rna' value is 'true', we instantiate SignupForm in 'rna' scenario
        $model = $rna ? new SignupForm(['scenario' => 'rna']) : new SignupForm();

        // if validation didn't pass, reload the form to show errors
        if (!$model->load(Yii::$app->request->post()) || !$model->validate()) {
            return $this->render('signup', ['model' => $model]);  
        }

        // try to save user data in database, if successful, the user object will be returned
        $user = $model->signup();

        if (!$user) {
            // display error message to user
            Yii::$app->session->setFlash('error', Yii::t('app', 'We couldn\'t sign you up, please contact us.'));
            return $this->refresh();
        }

        // user is saved but activation is needed, use signupWithActivation()
        if ($user->status === User::STATUS_INACTIVE) {
            $this->signupWithActivation($model, $user);
            return $this->refresh();
        }

        // now we will try to log user in
        // if login fails we will display error message, else just redirect to home page
    
        if (!Yii::$app->user->login($user)) {
            // display error message to user
            Yii::$app->session->setFlash('warning', Yii::t('app', 'Please try to log in.'));

            // log this error, so we can debug possible problem easier.
            Yii::error('Login after sign up failed! User '.Html::encode($user->username).' could not log in.');
        }
                      
        return $this->goHome();
    }

    /**
     * Tries to send account activation email.
     *
     * @param $model
     * @param $user
     */
    private function signupWithActivation($model, $user)
    {
        // sending email has failed
        if (!$model->sendAccountActivationEmail($user)) {
            // display error message to user
            Yii::$app->session->setFlash('error', Yii::t('app', 
                'We couldn\'t send you account activation email, please contact us.'));

            // log this error, so we can debug possible problem easier.
            Yii::error('Signup failed! User '.Html::encode($user->username).' could not sign up. 
                Possible causes: verification email could not be sent.');
        }

        // everything is OK
        Yii::$app->session->setFlash('success', Yii::t('app', 'Hello').' '.Html::encode($user->username). '. ' .
            Yii::t('app', 'To be able to log in, you need to confirm your registration. 
                Please check your email, we have sent you a message.'));
    }

/*--------------------*
 * ACCOUNT ACTIVATION *
 *--------------------*/

    /**
     * Activates the user account so he can log in into system.
     *
     * @param  string $token
     * @return \yii\web\Response
     *
     * @throws BadRequestHttpException
     */
    public function actionActivateAccount($token)
    {
        try {
            $user = new AccountActivation($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if (!$user->activateAccount()) {
            Yii::$app->session->setFlash('error', Html::encode($user->username). Yii::t('app', 
                ' your account could not be activated, please contact us!'));
            return $this->goHome();
        }

        Yii::$app->session->setFlash('success', Yii::t('app', 'Success! You can now log in.').' '.
            Yii::t('app', 'Thank you').' '.Html::encode($user->username).' '.Yii::t('app', 'for joining us!'));

        return $this->redirect('login');
    }
/**
* Vraca trenutnu temperaturu u navedenom gradu
*
* @param string $grad Ime grada
* @return string
* @soap
*/
public function getTemperatura($grad)
{
    return 'Temperatura u gradu ' . $grad . ' je 23C.';
}
	/**
	* Vraca sve projekte
	* @param 
	* @return mixed
	* @soap
	*/
	public function getProjekti(){
		$projekti = Projekat::find()->asArray()->all();
		$array = (array)$projekti;
		return $array;
	}
	
	
	/**
	* Svi projektni po sefu
	* @param int $id 
	* @return mixed
	* @soap
	*/
	public function getProjektniPoSefu($id)
	{
		return Projekat::find()->where(['sef_na_projektu' => $id])->AsArray()->all();
	}

	/**
	* Svi projektni po sefu
	* @param 
	* @return mixed
	* @soap
	*/

	public function getMyActivities($username, $password, $id) {
		$return = []; 
		$ulogovan  = SiteController::wsLogin((string)$username, (string)$password);
		if( $ulogovan == "false"){
			return $return;
		}
		//$user = User::find()->where(['=', 'id', $id])->asArray()->one();
		
		if(User::isAdmin($id) || User::isCreator($id)){
			$return = Aktivnost::find()->AsArray()->all();
		} else {
			$ucesnik = Ucesnik::find()->where(['user_id' => $id])->AsArray()->one();
			$return = Aktivnost::find()->where(['ucesnik_id' => $ucesnik['id']])->AsArray()->all();
		}
		
		
		foreach($return as &$i) {
			$ucesnik = Ucesnik::find()->where(['id' => (int)$i['ucesnik_id']])->AsArray()->one();
			$zadatak = Zadatak::find()->where(['id' => (int)$i['zadatak_id']])->AsArray()->one();
			$projekat = Projekat::find()->where(['id' => (int)$zadatak['projekat_id']])->AsArray()->one();
			$i['ime_ucesnika'] = $ucesnik['ime'] . ' ' . $ucesnik['prezime'];
			$i['ime_projekta'] = $projekat['naziv'];
		}
		return $return;
	}
		/**
	* Naziv zadatka
	* @param 
	* @return mixed
	* @soap
	*/
	public function getZadatakName($username, $password, $id)
	{	$return = []; 
		$ulogovan  = SiteController::wsLogin((string)$username, (string)$password);
		if( $ulogovan == "false"){
			return $return;
		}
		$zadatak = Zadatak::find()->where(['id' => $id])->AsArray()->one();
		$ime = $zadatak['naziv'];
		return $ime;
	}
	
	/**
	* Svi ucesnici
	*
	* @return mixed
	* @soap
	*/
	public function getUcesnici($username, $password)
	{
		$return = []; 
		$ulogovan  = SiteController::wsLogin((string)$username, (string)$password);
		if( $ulogovan == "false"){
			return $return;
		}
		return Ucesnik::find()->AsArray()->all();
	}
	
	/**
	* Vraca trenutnu temperaturu u navedenom gradu
	*
	* @param string $username Username
	* @param string $password Password
	* @return string
	* @soap
	*/
	public function wsLogin($username,$password)
	{
	   
		$found = 'nasao';
		$user = User::find()->where(['username' => $username])->one();
		
		if($user == null) {
			return "false";
		}

		$hash = Yii::$app->getSecurity()->generatePasswordHash($password);
		$passhash =$user->password_hash;

		if (Yii::$app->getSecurity()->validatePassword($password, $passhash)) {
			$found = $user->id;
		} else {
			$found = "false";
		}
		return $found ;
	}
	
	
	
	/**
	* Vraca trenutnu temperaturu u navedenom gradu
	*
	* @param int $id ID
	* @return mixed
	* @soap
	*/
	public function getRadnici($username, $password, $id)
	{	
		$return = []; 
		$ulogovan  = SiteController::wsLogin((string)$username, (string)$password);
		if( $ulogovan == "false"){
			return $return;
		}
		$user = User::find()->where(['id' => $id])->one();
		
		if(User::isRadnik($id)){
			return Ucesnik::find()->where(['user_id' => $id])->AsArray()->all();
		} else {
			return Ucesnik::find()->where(['vrsta_ucesnika' => 'radnik'])->AsArray()->all();
		}
		
		
	}
	
	/**
	* Vraca trenutnu temperaturu u navedenom gradu
	*
	* @return mixed
	* @soap
	*/
	public function getZadaci($username, $password)
	{	
		$return = []; 
		$ulogovan  = SiteController::wsLogin((string)$username, (string)$password);
		if( $ulogovan == "false"){
			return $return;
		}
		return Zadatak::find()->AsArray()->all();
	}
	
	/**
	* Vraca trenutnu temperaturu u navedenom gradu
	*
	* @param int $id ID
	* @return mixed
	* @soap
	*/
	public function getUser($username, $password, $id)
	{	$return = []; 
		$ulogovan  = SiteController::wsLogin((string)$username, (string)$password);
		if( $ulogovan == "false"){
			return $return;
		}
		return Ucesnik::find()->where(['user_id' => $id])->AsArray()->all();
	}
	
	
	
	
	/**
	* save\update aktivnosti
	*
	* @param int $id ID
	* @param int $ucesnik_id ID
	* @param int $zadatak_id ID
	* @param string $opis Opis
	* @param string $potroseno_vremena Potroseno Vremena
	* @param string $datum Datum
	* @param int $postoji ID
	* @return bool
	* @soap
	*/
	public function saveActivity($username, $password, $id, $ucesnik_id, $zadatak_id, $opis, $potroseno_vremena, $datum, $postoji)
	{	
		$return = []; 
		$ulogovan  = SiteController::wsLogin((string)$username, (string)$password);
		if( $ulogovan == "false"){
			return $return;
		}else{
		$model = null;
		if((int)$id > 0) {
			$model = Aktivnost::findOne((int)$id);
		} else {
			$model = new Aktivnost();
		}
		
		$model->ucesnik_id = (int)$ucesnik_id;
		$model->zadatak_id = (int)$zadatak_id;
		$model->opis = $opis;
		$model->potroseno_vremena = $potroseno_vremena;
		
		$model->datum = date('Y-m-d',strtotime($datum));
		$model->postoji = (int)$postoji;
		try{
			$model->save();
		}
		catch (\Exception $e) {
			return false;
		}
		}
		return true;$model->datum = date('Y-m-d',strtotime($datum));
	}
	
	/**
	* Obrisi projekat
	*
	* @param int $id id aktivnosti
	* @return boolean
	* @soap
	*/
	public function deleteActivity($username, $password, $id)
		{
		$ulogovan  = SiteController::wsLogin((string)$username, (string)$password);
		if( $ulogovan == "false"){
			return false;
		}else{
		if(Aktivnost::findOne($id)->deleteWithRelated())
			{
			return true;
			$model->save();
			}
		else
			{			
			$model->save();
			}
			return false;
		}
	}
}

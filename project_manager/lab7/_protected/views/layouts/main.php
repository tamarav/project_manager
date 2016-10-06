<?php
/* @var $this \yii\web\View */
/* @var $content string */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;


AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link href='https://fonts.googleapis.com/css?family=Ubuntu:400,700' rel='stylesheet' type='text/css'>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::t('app', Yii::$app->name),
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-default navbar-fixed-top',
        ],
    ]);

    // everyone can see Home page
    $menuItems[] = ['label' => Yii::t('app', 'Home'), 'url' => ['/index.php']];
	
    // display Users to admin+ roles
	if (Yii::$app->user->can('admin')){
        $menuItems[] = ['label' => Yii::t('app', 'Users'), 'url' => ['user/index']];
		$menuItems[] = ['label' => Yii::t('app', 'Ucesnik'), 'url' => ['/ucesnik/index']];
		$menuItems[] = ['label' => Yii::t('app', 'Projekat'), 'url' => ['/projekat/index']];
		$menuItems[] = ['label' => Yii::t('app', 'Zadatak'), 'url' => ['/zadatak/index']];
		$menuItems[] = ['label' => Yii::t('app', 'Aktivnost'), 'url' => ['/aktivnost/index']];
		$menuItems[] = ['label' => Yii::t('app', 'Zaduzenja na projektu'), 'url' => ['/radi-na-projektu/index']];
		$menuItems[] = ['label' => Yii::t('app', 'Zaduzenja na zadatku'), 'url' => ['/radi-na-zadatku/index']];
		$menuItems[] = ['label' => Yii::t('app', 'Prihodi'), 'url' => ['/prihod/index']];
		$menuItems[] = ['label' => Yii::t('app', 'Rashod'), 'url' => ['/rashod/index']];
	}
	else if (Yii::$app->user->can('radnik')){
		$menuItems[] = ['label' => Yii::t('app', 'Aktivnost'), 'url' => ['/aktivnost/index']];
		$menuItems[] = ['label' => Yii::t('app', 'Prihod'), 'url' => ['/prihod/index']];
		$menuItems[] = ['label' => Yii::t('app', 'Rashod'), 'url' => ['/rashod/index']];
    }
	else if (Yii::$app->user->can('nadzor')){
		$menuItems[] = ['label' => Yii::t('app', 'Projekat'), 'url' => ['/projekat/index']];
		$menuItems[] = ['label' => Yii::t('app', 'Zadatak'), 'url' => ['/zadatak/index']];
		$menuItems[] = ['label' => Yii::t('app', 'Aktivnost'), 'url' => ['/aktivnost/index']];
		$menuItems[] = ['label' => Yii::t('app', 'Prihod'), 'url' => ['/prihod/index']];
		$menuItems[] = ['label' => Yii::t('app', 'Rashod'), 'url' => ['/rashod/index']];
		$menuItems[] = ['label' => Yii::t('app', 'Zaduzenja na projektu'), 'url' => ['/radi-na-projektu/index']];
		$menuItems[] = ['label' => Yii::t('app', 'Zaduzenja na zadatku'), 'url' => ['/radi-na-zadatku/index']];
    }else if (Yii::$app->user->can('sef projekta')){
		$menuItems[] = ['label' => Yii::t('app', 'Projekat'), 'url' => ['/projekat/index']];
		$menuItems[] = ['label' => Yii::t('app', 'Zadatak'), 'url' => ['/zadatak/index']];
		$menuItems[] = ['label' => Yii::t('app', 'Aktivnost'), 'url' => ['/aktivnost/index']];
		$menuItems[] = ['label' => Yii::t('app', 'Prihod'), 'url' => ['/prihod/index']];
		$menuItems[] = ['label' => Yii::t('app', 'Rashod'), 'url' => ['/rashod/index']];
		$menuItems[] = ['label' => Yii::t('app', 'Zaduzenja na projektu'), 'url' => ['/radi-na-projektu/index']];
		$menuItems[] = ['label' => Yii::t('app', 'Zaduzenja na zadatku'), 'url' => ['/radi-na-zadatku/index']];	
    }
	
	
	
// $role = Yii::$app->authManager->getRoles(Yii::$app->user->id);
// var_dump($role);exit;    
    
    // display Logout to logged in users
    if (!Yii::$app->user->isGuest) {
        $menuItems[] = [
            'label' => Yii::t('app', 'Logout'). ' (' . Yii::$app->user->identity->username . ')',
            'url' => ['/site/logout'],
            'linkOptions' => ['data-method' => 'post']
        ];
    }

    // display Signup and Login pages to guests of the site
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => Yii::t('app', 'Signup'), 'url' => ['/site/signup']];
        $menuItems[] = ['label' => Yii::t('app', 'Login'), 'url' => ['/site/login']];
    }

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);

    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= Yii::t('app', Yii::$app->name) ?> <?= date('Y') ?></p>
        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

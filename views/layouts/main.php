<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\assets\AppAsset;
use app\components\FooterWidget;
use app\components\HeaderWidget;
use app\components\RightSidebarWidget;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

AppAsset::register($this);
?>
<?php $this->beginPage();?>
<!DOCTYPE html>
<html lang="<?=Yii::$app->language;?>">
<head>
    <meta charset="<?=Yii::$app->charset;?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?=Html::csrfMetaTags();?>
    <title><?=Html::encode($this->title);?></title>
    <?=$this->head();?>
</head>
<body>
<?php $this->beginBody();?>

<?=HeaderWidget::widget();?>

<div class="wrap">
<?php
/*
NavBar::begin([
'brandLabel' => 'My Company',
'brandUrl'   => Yii::$app->homeUrl,
'options'    => [
'class' => 'navbar-inverse navbar-fixed-top',
],
]);
echo Nav::widget([
'options' => ['class' => 'navbar-nav navbar-right'],
'items'   => [
['label' => 'Home', 'url' => ['/site/index']],
['label' => 'About', 'url' => ['/site/about']],
['label' => 'Contact', 'url' => ['/site/contact']],
Yii::$app->user->isGuest ?
['label' => 'Login', 'url' => ['/site/login']] :
[
'label'       => 'Logout (' . Yii::$app->user->identity->username . ')',
'url'         => ['/site/logout'],
'linkOptions' => ['data-method' => 'post'],
],
],
]);
NavBar::end();
 */
;?>

    <div class="container">
<?php
echo Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]);
?>
        <div class="row">
            <div class="main-content col-md-9" role="main">
            <?=$content;?>
            </div>
            <?=RightSidebarWidget::widget();?>
        </div>
    </div>
</div>

<?=FooterWidget::widget();?>


<?php $this->endBody();?>
</body>
</html>
<?php $this->endPage();?>

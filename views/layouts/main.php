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
    <div class="container">
        <?=Breadcrumbs::widget(['links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : []]);?>
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

<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\assets\AppAsset;
use app\components\FooterWidget;
use app\components\HeaderWidget;
use app\components\RightSidebarWidget;
use app\components\StatBaiduWidget;
use app\components\StatCNZZWidget;
use app\components\StatGoogleWidget;
use app\components\StatHaosouWidget;
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
    <meta name="msvalidate.01" content="79CB6DB3409259DA4D554FB7A083502C" />
    <meta name="myad_verifycode" content="ODjGtz93208KZder2X9dKnF3jvyqBNQo" />
    <meta name="baidu-site-verification" content="6FqC6DJiRE" />
    <meta name="google-translate-customization" content="ab1d78a45d40d60d-6105f0c13ad17d36-g7e2d028b4b2ec897-f" />
    <meta name="chinaz-site-verification" content="6eee6d5e-226d-485a-a134-6bde0390bbb9" />
    <meta name="robots" content="index,follow" />
    <?=Html::csrfMetaTags();?>
    <title><?=Html::encode($this->title);?></title>
    <?=$this->head();?>
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="icon" href="/favicon.ico" type="image/x-icon" />
    <link rel="alternate" type="application/rss+xml" title="Gowhich » Feed" href="/sitemap.xml" />
    <link rel="alternate" type="application/rss+xml" title="Gowhich » Comments Feed" href="/feed" />
    <link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="http://www.gowhich.com/feed" />
</head>
<body>
<?=StatGoogleWidget::widget();?>

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
<?=StatBaiduWidget::widget();?>
<?=StatCNZZWidget::widget();?>
<?=StatHaosouWidget::widget();?>
</body>
</html>
<?php $this->endPage();?>

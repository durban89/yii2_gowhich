<?php
use app\components\ArticleRowWidget;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */

$this->title = Yii::$app->params['title'] . '-' . Yii::$app->params['name']; //$this->params['name'];
?>

<?=ArticleRowWidget::widget(['articles' => $models]);?>

<?=LinkPager::widget(['pagination' => $pagination]);?>
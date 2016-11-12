<?php
use app\components\ArticleWidget;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */

$this->title = Yii::$app->params['title'] . '-' . Yii::$app->params['name']; //$this->params['name'];
?>

<?=ArticleWidget::widget(['articles' => $models]);?>

<?=LinkPager::widget(['pagination' => $pagination]);?>
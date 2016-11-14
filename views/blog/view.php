<?php

use app\components\ArticleWidget;

$this->title = Yii::$app->params['title'] . '-' . Yii::$app->params['name']; //$this->params['name'];

?>

<?=ArticleWidget::widget(['article' => $model]);?>

<?php

use app\components\ArticleWidget;

$this->title = $model->title . '-' . Yii::$app->params['name']; //$this->params['name'];

?>

<?=ArticleWidget::widget(['article' => $model, 'prevArticle' => $prev, 'nextArticle' => $next]);?>

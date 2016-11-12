<?php

use app\components\ArticleWidget;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */

$this->title = Yii::$app->params['title'] . '-' . Yii::$app->params['name']; //$this->params['name'];
?>

<header class="page-header">
    <h3>
        Search Results for <?=$keywords;?>
    </h3>

</header>

<?php if (!isset($model) || !$model): ?>
<div class="not-found">
    <h1>Nothing found!</h1>
</div>
<?php else: ?>
<?=ArticleWidget::widget(['articles' => $model]);?>

<?=LinkPager::widget(['pagination' => $pagination]);?>
<?php endif;?>
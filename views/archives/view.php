<?php
use app\components\ArticleRowWidget;
use yii\widgets\LinkPager;

$this->title                   = Yii::$app->params['title'] . '-' . Yii::$app->params['name'];
$this->params['breadcrumbs'][] = 'Archives';
?>

<header class="page-header">
    <h3>
        All Archives by <?=$year;?><?=$month ? '-' . $month : '';?>
    </h3>

</header>

<?=ArticleRowWidget::widget(['articles' => $models]);?>

<?=LinkPager::widget(['pagination' => $pagination]);?>

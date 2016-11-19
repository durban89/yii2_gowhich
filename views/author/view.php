<?php
use app\components\ArticleRowWidget;
use yii\widgets\LinkPager;

$this->title                   = Yii::$app->params['title'] . '-' . Yii::$app->params['name'];
$this->params['breadcrumbs'][] = 'Author';
?>

<header class="page-header">
    <h3>
        All posts by <?=$author;?>
    </h3>

    <!-- <p>Category描述</p> -->

</header>

<?=ArticleRowWidget::widget(['articles' => $models]);?>

<?=LinkPager::widget(['pagination' => $pagination]);?>

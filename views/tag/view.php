<?php
use app\components\ArticleRowWidget;
use yii\widgets\LinkPager;

$this->title                   = Yii::$app->params['title'] . '-' . Yii::$app->params['name']; //$this->params['name'];
$this->params['breadcrumbs'][] = 'Tag';
?>

<header class="page-header">
    <h3>
        Tag Archives for  <?=$tag;?>
    </h3>

    <!-- <p>Tag描述</p> -->

</header>

<?=ArticleRowWidget::widget(['articles' => $models]);?>

<?=LinkPager::widget(['pagination' => $pagination]);?>

<?php

use app\components\TagWidget;
use yii\helpers\Html;
use yii\helpers\StringHelper;
use yii\helpers\Url;
use yii\web\View;

$this->registerJsFile('//gowhich.disqus.com/count.js', ['async' => true, 'id' => 'dsq-count-scr'], View::POS_END);
?>
<?php if (isset($articles) && count($articles)): ?>
<?php foreach ($articles as $k => $v): ?>
<article id="post-8" class="post-<?=$v->id;?> post type-post status-publish format-standard hentry category-uncategorized tag-html tag-wordpress">

    <header class="entry-header">
        <h1><a href="<?=Url::to(['site/view', 'id' => $v->id]);?>" rel="bookmark"><?=$v->title;?></a></h1>

        <p class="entry-meta">
            <ul class="list-inline entry-meta">
                <li class="meta-date"> Posted on <a href="https://wp-themes.com/?p=8" rel="date">
                <time datetime="<?=date('c', strtotime($v->create_date));?>" class="timeago"><?=date('m-d,Y', strtotime($v->create_date));?></time></a></li>
                <li class="meta-author"> by <a href="<?=Url::to(['author/index', 'author' => $v->user->username]);?>" rel="author"><?=$v->user->username;?></a></li>
            </ul>
       </p>
    </header>

    <div class="entry-content">
    <?=StringHelper::truncate($v->description, 700, '...', null, true);?>
    </div>

    <footer class="entry-footer">
        <ul class="list-inline entry-meta">
            <li class="meta-categories"> Categorized in <a href="<?=Url::to(['category/view', 'category' => Html::encode(urlencode($v->category->name))]);?>" rel="category"><?=$v->category->name;?></a> </li>
            <?=TagWidget::widget(['tag' => $v->tag]);?>
            <li class="pull-right clear-right">
                <i class="fa fa-comments"></i>
                <span class="meta-reply"><a href="http://www.gowhich.com/blog/12#disqus_thread">One comment so far</a></span>
            </li>
        </ul>
    </footer>
</article>
<?php endforeach;?>
<?php endif;?>
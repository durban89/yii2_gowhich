<?php

use app\components\TagWidget;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

$this->registerJsFile('//gowhich.disqus.com/count.js', ['async' => true, 'id' => 'dsq-count-scr'], View::POS_END);
?>
<?php if (isset($article)): ?>
<article id="post-8" class="post-<?=$article->id;?> post type-post status-publish format-standard hentry category-uncategorized tag-html tag-wordpress">

    <header class="entry-header">
        <h1><a href="<?=Url::to(['blog/view', 'id' => $article->id]);?>" rel="bookmark"><?=$article->title;?></a></h1>

        <p class="entry-meta">
            <ul class="list-inline entry-meta">
                <li class="meta-date"> Posted on <a href="https://wp-themes.com/?p=8" rel="date">
                <time datetime="<?=date('c', strtotime($article->create_date));?>" class="timeago"><?=date('m-d,Y', strtotime($article->create_date));?></time></a></li>
                <li class="meta-author"> by <a href="<?=Url::to(['author/view', 'author' => $article->user->username]);?>" rel="author"><?=$article->user->username;?></a></li>
            </ul>
       </p>
    </header>

    <div class="entry-content">
    <?=$article->description;?>
    </div>

    <footer class="entry-footer">
        <ul class="list-inline entry-meta">
            <li class="meta-categories"> Categorized in <a href="<?=Url::to(['category/view', 'category' => Html::encode(urlencode($article->category->name))]);?>" rel="category"><?=$article->category->name;?></a> </li>
            <?=TagWidget::widget(['tag' => $article->tag]);?>
            <li class="pull-right clear-right">
                <i class="fa fa-comments"></i>
                <span class="meta-reply"><a href="http://www.gowhich.com/blog/12#disqus_thread">One comment so far</a></span>
            </li>
        </ul>
    </footer>
</article>
<?php endif;?>
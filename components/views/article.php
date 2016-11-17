<?php

use app\components\TagWidget;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

$this->registerJsFile('//gowhich.disqus.com/count.js', ['async' => true, 'id' => 'dsq-count-scr'], View::POS_END);
?>
<?php if (isset($article)): ?>
<article id="post-<?=$article->id;?>" class="post-<?=$article->id;?> post type-post status-publish format-standard hentry category-uncategorized tag-html tag-wordpress">

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
        <ul class="list-inline entry-meta" style="height: 32px;line-height: 32px">
            <li class="meta-categories"> Categorized in <a href="<?=Url::to(['category/view', 'category' => Html::encode(urlencode($article->category->name))]);?>" rel="category"><?=$article->category->name;?></a> </li>
            <?=TagWidget::widget(['tag' => $article->tag]);?>
            <!-- JiaThis Button BEGIN -->
            <li class="pull-right clear-right">
                <div class="jiathis_style_32x32 share-icon-container">
                  <a class="jiathis_button_tsina icon tsina"></a>
                  <a class="jiathis_button_douban icon douban"></a>
                  <a class="jiathis_button_googleplus icon googleplus"></a>
                  <a class="jiathis_button_fb icon fb"></a>
                  <a class="jiathis_button_twitter icon twitter"></a>
                  <a class="jiathis_button_linkedin icon linkedin"></a>
                </div>
            </li>
            <script type="text/javascript" >
            var jiathis_config={
                data_track_clickback:true,
                summary:"",
                shortUrl:false,
                hideMore:true
            }
            </script>
            <script type="text/javascript" src="http://v3.jiathis.com/code/jia.js?uid=1571129" charset="utf-8"></script>
            <!-- JiaThis Button END -->
        </ul>
    </footer>
</article>
<?php endif;?>

<ul class="pager">
    <?php if ($prevArticle): ?>
    <li><a class="withripple" href="<?=Url::to(['blog/view', 'id' => $prevArticle->id]);?>">Previous</a></li>
    <?php endif;?>
    <?php if ($nextArticle): ?>
    <li><a class="withripple" href="<?=Url::to(['blog/view', 'id' => $nextArticle->id]);?>">Next</a></li>
    <?php endif;?>
</ul>
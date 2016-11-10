<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<aside class="sidebar col-md-3" role="complementary">
    <div id="recent-posts-3" class="widget widget_recent_entries">
        <img src='http://7sbph3.com1.z0.glb.clouddn.com/2.png' width="100%" />
    </div>

    <div id="recent-posts-3" class="widget widget_recent_entries">
        <h5 class="widget-title">Recent Posts</h5>
        <ul>
            <li>
                <a href="https://wp-themes.com/?p=19">Worth A Thousand Words</a>
            </li>
            <li>
                <a href="https://wp-themes.com/?p=36">Elements</a>
            </li>
            <li>
                <a href="https://wp-themes.com/?p=14">More Tags</a>
            </li>
            <li>
                <a href="https://wp-themes.com/?p=8">HTML</a>
            </li>
            <li>
                <a href="https://wp-themes.com/?p=6">Links</a>
            </li>
        </ul>
    </div>
    <div id="recent-comments-3" class="widget widget_recent_comments">
        <h5 class="widget-title">Recent Comments</h5>
        <ul id="recentcomments"><li class="recentcomments"><span class="comment-author-link"><a href='http://josephscott.org/' rel='external nofollow' class='url'>Joseph Scott</a></span> on <a href="https://wp-themes.com/?p=1#comment-509">Hello world!</a></li><li class="recentcomments"><span class="comment-author-link"><a href='http://joseph.randomnetworks.com/' rel='external nofollow' class='url'>Joseph Scott</a></span> on <a href="https://wp-themes.com/?p=8#comment-2">HTML</a></li><li class="recentcomments"><span class="comment-author-link"><a href='http://wordpress.org/' rel='external nofollow' class='url'>Mr WordPress</a></span> on <a href="https://wp-themes.com/?p=1#comment-1">Hello world!</a></li></ul></div> <!-- end widget --><div id="archives-3" class="widget widget_archive"><h5 class="widget-title">Archives</h5>     <ul>
            <li><a href='https://wp-themes.com/?m=200810'>October 2008</a></li>
            <li><a href='https://wp-themes.com/?m=200809'>September 2008</a></li>
            <li><a href='https://wp-themes.com/?m=200806'>June 2008</a></li>
        </ul>
    </div>

    <?php if (isset($blogCategory) && count($blogCategory)): ?>
    <div id="categories-3" class="widget widget_categories">
        <h5 class="widget-title">Categories</h5>
        <ul>
            <?php foreach ($blogCategory as $v): ?>
            <li class="cat-item cat-item-<?=$v->id;?>"><a title='<?=Html::encode($v->name);?>' href="<?=Url::toRoute(['category/view', 'category' => Html::encode(urlencode($v->name))]);?>" ><?=$v->name;?></a></li>
            <?php endforeach;?>
        </ul>
    </div>
    <?php endif;?>
</aside>

<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<aside class="sidebar col-md-3" role="complementary">
    <div id="recent-posts-3" class="widget widget_recent_entries">
        <img src='http://7sbph3.com1.z0.glb.clouddn.com/2.png' width="100%" />
    </div>

    <div id="recent-posts-3" class="widget widget_recent_entries">
        <h5 class="widget-title">QQ Group</h5>
        <ul>
            <li>
                <a target="_blank" href="http://shang.qq.com/wpa/qunwpa?idkey=6478598ea632d8cc4800ef0d7e066e0b823c97647f592b3fb72e0009f203b171" title="官方技术群:341268380">
                    <i class="fa fa-users"></i>
                    技术群:341268380
                </a>
            </li>
            <li>
                <a target="_blank" href="http://shang.qq.com/wpa/qunwpa?idkey=e89ae746d2e6747543fa74b3a65933d5185c4af29b11d46ad9c70cb302c744fa" title="IOS技术群:491229003">
                    <i class="fa fa-users"></i>
                    IOS技术群:491229003
                </a>
            </li>
            <li>
                <a target="_blank" href="http://shang.qq.com/wpa/qunwpa?idkey=f82b94d01032fdd77b9ab4a8762497514991f848ebd1a831f0748716aaf8ac00" title="RN技术群:491310686">
                    <i class="fa fa-users"></i>
                    RN技术群:491310686
                </a>
            </li>
        </ul>
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

<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\assets\AppAsset;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

AppAsset::register($this);
?>
<?php $this->beginPage();?>
<!DOCTYPE html>
<html lang="<?=Yii::$app->language;?>">
<head>
    <meta charset="<?=Yii::$app->charset;?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?=Html::csrfMetaTags();?>
    <title><?=Html::encode($this->title);?></title>
    <?=$this->head();?>
</head>
<body>
<?php $this->beginBody();?>

<header class="site-header" role="banner">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12 banner">
                <img class="site-banner" src="/images/banner.png" width="1920"  alt="" />
            </div><!-- /.col-xs-12 -->
        </div><!-- /.row -->
    </div> <!-- end banner -->

    <div class="container header-contents">
        <div class="row">
            <div class="col-xs-9 sitelogo">
                <div class="site-logo">
                    <a href="/" rel="home"><?=Yii::$app->params['name'];?></a>
                    <div class="tagline"><?=Yii::$app->params['description'];?></div>
                </div>
            </div>
            <div class="col-xs-12">
                <nav class="navbar navbar-default" role="navigation">
                    <div class="menu-short-container container-fluid">
                        <div class="navbar-header">
                          <button type="button" class="navbar-toggle collapsed navbar-color-mod" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                          </button>
                        </div>

                        <div class="collapse navbar-collapse">
                            <div class="site-menu">
                                <ul class="nav navbar-nav">
                                    <li class="active"><a href="javascript:void(0)">Active</a></li>
                                    <li><a href="javascript:void(0)">Link</a></li>
                                    <li class="dropdown">
                                        <a href="bootstrap-elements.html" data-target="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown
                                        <b class="caret"></b></a>
                                        <ul class="dropdown-menu">
                                            <li><a href="javascript:void(0)">Action</a></li>
                                            <li><a href="javascript:void(0)">Another action</a></li>
                                            <li><a href="javascript:void(0)">Something else here</a></li>
                                            <li class="divider"></li>
                                            <li class="dropdown-header">Dropdown header</li>
                                            <li><a href="javascript:void(0)">Separated link</a></li>
                                            <li><a href="javascript:void(0)">One more separated link</a></li>
                                        </ul>
                                    </li>
                                </ul>
                                <form class="navbar-form navbar-right">
                                    <div class="form-group">
                                        <input type="text" class="form-control col-md-8" placeholder="Search">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>

<div class="wrap">
<?php
/*
NavBar::begin([
'brandLabel' => 'My Company',
'brandUrl'   => Yii::$app->homeUrl,
'options'    => [
'class' => 'navbar-inverse navbar-fixed-top',
],
]);
echo Nav::widget([
'options' => ['class' => 'navbar-nav navbar-right'],
'items'   => [
['label' => 'Home', 'url' => ['/site/index']],
['label' => 'About', 'url' => ['/site/about']],
['label' => 'Contact', 'url' => ['/site/contact']],
Yii::$app->user->isGuest ?
['label' => 'Login', 'url' => ['/site/login']] :
[
'label'       => 'Logout (' . Yii::$app->user->identity->username . ')',
'url'         => ['/site/logout'],
'linkOptions' => ['data-method' => 'post'],
],
],
]);
NavBar::end();
 */
;?>

    <div class="container">
<?php
echo Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]);
?>
        <div class="row">
            <div class="main-content col-md-9" role="main">
            <?=$content;?>
            </div>
            <aside class="sidebar col-md-3" role="complementary">
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

                <div id="categories-3" class="widget widget_categories">
                    <h5 class="widget-title">Categories</h5>
                    <ul>
                        <li class="cat-item cat-item-6"><a href="https://wp-themes.com/?cat=6" >First Child Category</a></li>
                        <li class="cat-item cat-item-8"><a href="https://wp-themes.com/?cat=8" >One Grandchild Category</a></li>
                        <li class="cat-item cat-item-5"><a href="https://wp-themes.com/?cat=5" >Parent</a></li>
                        <li class="cat-item cat-item-7"><a href="https://wp-themes.com/?cat=7" >Second Child Category</a></li>
                        <li class="cat-item cat-item-1"><a href="https://wp-themes.com/?cat=1" >Uncategorized</a></li>
                    </ul>
                </div>
            </aside>
        </div>
    </div>
</div>

<footer class="site-footer">
    <div class="container">
        <div class="copyright">
            <p class="pull-left">
                &copy; <?=date('Y');?>
                <a href="/"><?=Yii::$app->params['name'];?></a>
                &#12288;
                <a class="author-url" href="http://standew.com/klyment">Theme Material</a>
            </p>

            <p class="pull-right"><?=Yii::powered();?></p>
        </div>
    </div>
</footer>


<?php $this->endBody();?>
</body>
</html>
<?php $this->endPage();?>

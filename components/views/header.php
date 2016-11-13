<?php

use yii\helpers\Url;

?>
<header class="site-header" role="banner">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12 banner">
                <img class="site-banner" src="/images/banner.png" width="1920"  alt="" />
            </div>
        </div>
    </div>

    <div class="container header-contents">
        <div class="row">
            <div class="col-xs-12 sitelogo">
                <div class="site-logo">
                    <a href="<?=Url::to(['site/index']);?>" rel="home"><?=Yii::$app->params['name'];?></a>
                    <div class="tagline"><?=Yii::$app->params['description'];?></div>
                </div>
            </div>
            <div class="col-xs-12">
                <nav class="navbar navbar-default" role="navigation">
                    <div class="menu-short-container container-fluid">
                        <div class="navbar-header">
                          <button type="button" class="navbar-toggle collapsed navbar-color-mod" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                          </button>
                        </div>

                        <div class="collapse navbar-collapse navbar-responsive-collapse">
                            <div class="site-menu">
                                <ul class="nav navbar-nav">
                                    <?php foreach ($nav as $k => $v): ?>
                                        <?php if (isset($v['child'])): ?>
                                        <li class="dropdown <?=$v['active'] ? 'active' : '';?>">
                                            <a href="#" data-target="#" class="dropdown-toggle" data-toggle="dropdown">
                                                <?=$v['title'];?>
                                                <b class="caret"></b>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <?php foreach ($v['child'] as $ck => $cv): ?>
                                                <li class="<?=$cv['active'] ? 'active' : '';?>"><a href="<?=$cv['link'];?>"><?=$cv['title'];?></a></li>
                                                <?php endforeach;?>
                                            </ul>
                                        </li>
                                        <?php else: ?>
                                        <li class="<?=$v['active'] ? 'active' : '';?>"><a href="<?=$v['link'];?>"><?=$v['title'];?></a></li>
                                        <?php endif;?>

                                    <?php endforeach;?>

                                    <!-- <li><a href="<?=Url::to(['site/about']);?>">About Me</a></li>
                                    <li class="dropdown active">
                                        <a href="#" data-target="#" class="dropdown-toggle" data-toggle="dropdown">
                                            Online Study
                                            <b class="caret"></b>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li class="active"><a href="<?=Url::to(['site/video']);?>">iOS Video</a></li>
                                            <li><a href="<?=Url::to(['site/resource']);?>">Technical Books</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="<?=Url::to(['site/social']);?>">Social Hub</a>
                                    </li>
                                    <li>
                                        <a href="<?=Url::to(['site/tools']);?>">Quick Access</a>
                                    </li> -->
                                </ul>
                                <form class="navbar-form navbar-right" id='blogSearchForm' method="get" action="<?=Url::to(['search/index']);?>">
                                    <div class="form-group">
                                        <input style='display:none' />
                                        <input type="text" class="form-control col-md-8" name="keywords" placeholder="Search" onKeypress="javascript:if(event.keyCode==13) {doSearch();return false;}"/>
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
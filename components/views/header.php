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
            <div class="col-xs-12 sitelogo">
                <div class="site-logo">
                    <a href="/" rel="home"><?=Yii::$app->params['name'];?></a>
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
                                    <li class="active"><a href="javascript:void(0)">首页</a></li>
                                    <li><a href="javascript:void(0)">Link</a></li>
                                    <li class="dropdown">
                                        <a href="#" data-target="#" class="dropdown-toggle" data-toggle="dropdown">
                                            Dropdown
                                            <b class="caret"></b>
                                        </a>
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
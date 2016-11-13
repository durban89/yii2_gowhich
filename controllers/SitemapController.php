<?php

namespace app\controllers;

use app\components\Sitemap;

class SitemapController extends \yii\web\Controller
{
    public function actionIndex()
    {
        //sitemap创建
        $sitemap = new Sitemap();

        return $this->render('index', array('sitemap' => $sitemap->show()));
    }

    public function actionXsl()
    {
        return $this->render('xsl', ['sitemap' => '']);
    }
}

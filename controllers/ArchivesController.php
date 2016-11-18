<?php

namespace app\controllers;

use app\models\Blog;

class ArchivesController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $model = Blog::find()->where()->all();
        return $this->render('index');
    }

    public function actionView($year, $date)
    {
        $model = Blog::find()->where()->all();
        return $this->render('view');
    }

}

<?php

namespace app\controllers;

use app\models\Blog;

class BlogController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionView($id)
    {
        $model = Blog::find()->where(['id' => $id])->one();

        return $this->render('view', ['model' => $model]);
    }
}

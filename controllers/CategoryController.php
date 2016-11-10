<?php

namespace app\controllers;

class CategoryController extends \yii\web\Controller
{
    public function actionIndex()
    {

        return $this->render('index');
    }

    public function actionView($category)
    {
        if ($category) {
            return $this->render('view');
        } else {
            return $this->render('index');
        }

    }

}

<?php

namespace app\controllers;

use Yii;

class ErrorController extends \yii\web\Controller
{
    public $layout = 'error';

    public function actions()
    {
        return [
            'index' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

}

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

        $this->blogClick($id);
        $prev = $this->viewPrev($id);
        $next = $this->viewNext($id);

        return $this->render('view', ['model' => $model]);
    }

    private function blogClick($id)
    {
        $model = Blog::find()->where(['id' => $id]);
        $model->read_sum += 1;
        $model->save();
    }

    private function prevBlog($id)
    {
        return Blog::find()->where(['<', 'id', $id])->orderBy('id', SORT_DESC)->one();
    }

    private function nextBlog($id)
    {
        return Blog::find()->where(['>', 'id', $id])->orderBy('id', SORT_ASC)->one();
    }
}

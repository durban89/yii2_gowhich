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
        $prev = $this->prevBlog($id);
        $next = $this->nextBlog($id);

        return $this->render('view', ['model' => $model, 'prev' => $prev, 'next' => $next]);
    }

    private function blogClick($id)
    {
        $model = Blog::findOne($id);
        $model->updateCounters(['read_sum' => 1]);
    }

    private function prevBlog($id)
    {
        return Blog::find()->where(['<', 'id', $id])->orderBy('id DESC')->one();
    }

    private function nextBlog($id)
    {
        return Blog::find()->where(['>', 'id', $id])->orderBy('id ASC')->one();
    }
}

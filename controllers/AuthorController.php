<?php

namespace app\controllers;

use app\models\Blog;
use app\models\User;
use yii\data\Pagination;

class AuthorController extends \yii\web\Controller
{
    public function actionIndex()
    {

        $models = User::find()->where(['is_lock' => 0, 'is_delete' => 0])
            ->orderBy('create_date', SORT_DESC)
            ->all();

        return $this->render('index', ['models' => $models]);

    }

    public function actionView($author)
    {

        if ($author) {
            $author = urldecode($author);
            $res    = User::find()->where(["username" => $author])->one();

            if ($res) {
                $query = Blog::find()->where(['user_id' => $res->id, 'is_lock' => 0, 'is_delete' => 0])
                    ->orderBy(['create_date' => SORT_DESC]);

                $pagination = new Pagination(['totalCount' => $query->count(), 'pageSize' => 12]);

                $models = $query->offset($pagination->offset)
                    ->limit($pagination->limit)
                    ->all();

                return $this->render('view', [
                    'author'     => $author,
                    'pagination' => $pagination,
                    'models'     => $models,
                ]);
            } else {
                $this->redirect(Url::to(['author/index']));
            }

        } else {
            $this->redirect(Url::to(['author/index']));
        }

    }

}

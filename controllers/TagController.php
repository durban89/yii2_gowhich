<?php

namespace app\controllers;

use app\models\Blog;
use yii\data\Pagination;
use yii\helpers\Html;

class TagController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $tagItems = array();

        $model = Blog::find()->select(['id', 'tag', 'update_date'])
            ->where(['is_lock' => 0, 'is_delete' => 0])
            ->orderBy('create_date', SORT_DESC)
            ->all();

        foreach ($model as $k => $v) {
            $tagArr = preg_split('#,|，#i', $v->tag);

            if (!empty($tagArr)) {
                foreach ($tagArr as $k => $v) {
                    if (!in_array($v, $tagItems)) {
                        $tagItems[] = preg_replace('/\.php/', '', $v);
                    }
                }
            }
        }

        return $this->render('index', ['models' => $tagItems]);
    }

    public function actionView($tag)
    {

        $tag = Html::encode(urldecode($tag));

        if ($tag) {
            $query = Blog::find()->where(['is_lock' => 0, 'is_delete' => 0])
                ->where(['like', 'tag', $tag])
                ->orderBy(['create_date' => SORT_DESC]);

            $pagination = new Pagination(['totalCount' => $query->count(), 'pageSize' => 12]);

            $models = $query->offset($pagination->offset)
                ->limit($pagination->limit)
                ->all();

            return $this->render('view', [
                'tag'        => $tag,
                'pagination' => $pagination,
                'models'     => $models,
            ]);

        } else {
            $this->redirect(Url::to(['tag/index']));
        }
    }

}

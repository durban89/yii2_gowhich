<?php

namespace app\controllers;

use app\models\Blog;
use Yii;
use yii\data\Pagination;
use yii\helpers\Html;

class SearchController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $keywords = Yii::$app->request->get('keywords', '');

        if (!$keywords) {
            $keywords = Yii::$app->request->get('key', '');
        }

        if ($keywords) {
            $keywords = Html::encode(urldecode($keywords));
            $query    = Blog::find()->where(['like', 'title', $keywords])
                ->andWhere(['like', 'description', $keywords])
                ->andWhere(['is_delete' => 0, 'is_lock' => 0])
                ->orderBy('create_date', SORT_DESC);

            $pagination = new Pagination(['totalCount' => $query->count(), 'pageSize' => 12]);
            $model      = $query->offset($pagination->offset)->limit($pagination->limit)->all();

            return $this->render('index', [
                'keywords'   => $keywords,
                'model'      => $model,
                'pagination' => $pagination,
            ]);
        } else {
            return $this->render('index', [
                'keywords' => $keywords,
            ]);
        }
    }

}

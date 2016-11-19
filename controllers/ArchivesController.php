<?php

namespace app\controllers;

use app\models\Blog;
use Yii;
use yii\data\Pagination;
use yii\helpers\Url;

class ArchivesController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $query = Blog::find()->where(['is_lock' => 0, 'is_delete' => 0])->orderBy('id DESC');

        $count = $query->count();

        $pagination = new Pagination(['totalCount' => $count, 'pageSize' => '12']);

        $models = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('index', [
            'models'     => $models,
            'pagination' => $pagination,
        ]);
    }

    public function actionView()
    {

        $year  = Yii::$app->request->get('year', '');
        $month = Yii::$app->request->get('month', '');

        if (!$year && !$month) {
            return $this->redirect(Url::to(['archives/index']), 302);
        }

        if ($year && !preg_match('/[1-9]{1}[0-9]{3}/', $year)) {
            return $this->redirect(Url::to(['archives/index']), 302);
        }

        if ($month && !preg_match('/[0-9]{1}[1-9]{1}/', $month)) {
            return $this->redirect(Url::to(['archives/index']), 302);
        }

        $query = Blog::find();

        if ($year && !$month) {
            $startDateTime = $year . '-01-01 00:00:00';
            $endDateTime   = date('Y' . '-01-01 00:00:00', strtotime('+1 year', strtotime($startDateTime)));

            $query = $query->where(['>=', 'create_date', $startDateTime])
                ->andWhere(['<', 'create_date', $endDateTime]);
        }

        if ($year && $month) {
            $startDateTime = $year . '-' . $month . '-01 00:00:00';
            $endDateTime   = date('Y-m' . '-01 00:00:00', strtotime('+1 month', strtotime($startDateTime)));

            $query = $query->where(['>=', 'create_date', $startDateTime])
                ->andWhere(['<', 'create_date', $endDateTime]);
        }

        $count = $query->count();

        $pagination = new Pagination(['totalCount' => $count, 'pageSize' => '12']);

        $models = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('view', [
            'year'       => $year,
            'month'      => $month,
            'models'     => $models,
            'pagination' => $pagination,
        ]);
    }

}

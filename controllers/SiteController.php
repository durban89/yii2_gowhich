<?php

namespace app\controllers;

use app\models\Blog;
use app\models\ContactForm;
use app\models\LoginForm;
use Yii;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\Controller;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only'  => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow'   => true,
                        'roles'   => ['@'],
                    ],
                ],
            ],
            'verbs'  => [
                'class'   => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error'   => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class'           => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        // 搜索跳转
        $t = Yii::$app->request->get('t', '');
        if ($t) {
            $this->redirect(Url::to(['search/index', 'keywords' => $t]));
        }

        // tag 链接指向
        $tag = Yii::$app->request->get('tag', '');
        if ($tag) {
            $this->redirect(Url::to(['tag/index', 'tag' => Html::encode($tag)]));
        }

        $query = Blog::find()->where([
            'is_lock'   => 0,
            'is_delete' => 0,
        ])->orderBy(['create_date' => SORT_DESC]);

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

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionAuthor()
    {
        return $this->render('author');
    }

    public function actionCategory()
    {
        return $this->render('category');
    }

    public function actionSearch()
    {
        return $this->render('search');
    }

    public function actionDetail()
    {

    }

    public function actionTag()
    {
        return $this->render('tag');
    }
}

<?php

namespace app\controllers;

use app\components\RSS;
use app\models\Blog;
use app\models\ContactForm;
use app\models\File;
use app\models\LoginForm;
use app\models\Type;
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
    public function actionFeed()
    {
        $model = Blog::find()->where([
            'is_delete' => 0,
            'is_lock'   => 0,
        ])->orderBy('create_date', SORT_DESC)
            ->offset(0)
            ->limit(50)->all();

        // $criteria            = new CDbCriteria();
        // $criteria->condition = 'is_lock = :is_lock AND is_delete = :is_delete';
        // $criteria->order     = 'create_date DESC';
        // $criteria->limit     = 50;
        // $criteria->offset    = 0;
        // $criteria->params    = array(
        //     ':is_lock'   => 0,
        //     ':is_delete' => 0,
        // );
        // $models = Blog::model()->findAll($criteria);

        //rss创建
        $feedTitle = Yii::$app->params['title'];
        $rss       = new RSS($feedTitle, Yii::$app->request->hostInfo, Yii::$app->params['description']);
        $rss->setWebMaster(Yii::$app->params['adminEmail']);
        $rss->setAuthor("Durban");
        foreach ($model as $key => $value) {
            $rss->addItem(
                $value->title,
                Url::to(['site/view', 'id' => $value->id]),
                $value->description,
                date('r', strtotime($value->create_date)),
                Url::to(['site/view', 'id' => $value->id])
            );
        }

        $this->render('feed', array('rss' => $rss->show()));
    }

    public function actionVideo()
    {
        $video = array(
            array(
                'title' => 'iOS Objective-C 视频教程', //iOS Objective-C 视频教程
                'id'    => 'youcai',
                'class' => 'active',
                'data'  => array(
                    array(
                        'title' => '一、iPhone开发概述及简介',
                        'class' => 'in',
                        'data'  => array(
                            array(
                                'title' => '1.1 iPhone开发概述-必看',
                                'url'   => 'http://www.tudou.com/l/_ZnZY_J94CY/&rpid=107340114&resourceId=107340114_04_05_99&iid=152236610/v.swf',
                            ),
                            array(
                                'title' => '1.2 iPhone开发之开发工具安装及介绍',
                                'url'   => 'http://www.tudou.com/l/_ZnZY_J94CY/&rpid=107340114&resourceId=107340114_04_05_99&iid=152224137/v.swf',
                            ),
                        ),
                    ),
                    array(
                        'title' => '二、Objective-C 基础语法',
                        'class' => '',
                        'data'  => array(
                            array(
                                'title' => '2.1 Objective-C的变量和常量',
                                'url'   => 'http://www.tudou.com/l/_ZnZY_J94CY/&rpid=107340114&resourceId=107340114_04_05_99&iid=152216365/v.swf',
                            ),
                            array(
                                'title' => '2.2 Objective-C的基本数据类型',
                                'url'   => 'http://www.tudou.com/l/_ZnZY_J94CY/&rpid=107340114&resourceId=107340114_04_05_99&iid=152227368/v.swf',
                            ),
                            array(
                                'title' => '2.3 Objective-C基本数据类型转换',
                                'url'   => 'http://www.tudou.com/l/_ZnZY_J94CY/&rpid=107340114&resourceId=107340114_04_05_99&iid=152232344/v.swf',
                            ),
                            array(
                                'title' => '2.4 Objective-C运算符和表达式',
                                'url'   => 'http://www.tudou.com/l/_ZnZY_J94CY/&rpid=107340114&resourceId=107340114_04_05_99&iid=152236510/v.swf',
                            ),
                            array(
                                'title' => '2.5 if语句和for循环语句',
                                'url'   => 'http://www.tudou.com/l/_ZnZY_J94CY/&rpid=107340114&resourceId=107340114_04_05_99&iid=152236589/v.swf',
                            ),
                            array(
                                'title' => '2.6 循环结构之while、break和continue',
                                'url'   => 'http://www.tudou.com/l/_ZnZY_J94CY/&rpid=107340114&resourceId=107340114_04_05_99&iid=152239577/v.swf',
                            ),
                            array(
                                'title' => '2.7 条件结构之 switch 语句',
                                'url'   => 'http://www.tudou.com/l/_ZnZY_J94CY/&rpid=107340114&resourceId=107340114_04_05_99&iid=152241823/v.swf',
                            ),
                            array(
                                'title' => '2.8 语法开发作业讲解',
                                'url'   => 'http://www.tudou.com/l/_ZnZY_J94CY/&rpid=107340114&resourceId=107340114_04_05_99&iid=152242279/v.swf',
                            ),
                            array(
                                'title' => '2.9 Objective-C开发之代码规范讲解',
                                'url'   => 'http://www.tudou.com/l/_ZnZY_J94CY/&rpid=107340114&resourceId=107340114_04_05_99&iid=152242849/v.swf',
                            ),
                            array(
                                'title' => '2.10 Objective-COC基础语法复习',
                                'url'   => 'http://www.tudou.com/l/_ZnZY_J94CY/&rpid=107340114&resourceId=107340114_04_05_99&iid=152243785/v.swf',
                            ),
                        ),
                    ),
                    array(
                        'title' => '三、Objective-C 语法进阶',
                        'class' => '',
                        'data'  => array(
                            array(
                                'title' => '3.1 面向对象的基本概念—类和对象',
                                'url'   => 'http://www.tudou.com/l/_ZnZY_J94CY/&rpid=107340114&resourceId=107340114_04_05_99&iid=153339895/v.swf',
                            ),
                            array(
                                'title' => '3.2 类的声明和对象的创建—内存分析1',
                                'url'   => 'http://www.tudou.com/l/_ZnZY_J94CY/&rpid=107340114&resourceId=107340114_04_05_99&iid=153345997/v.swf',
                            ),
                            array(
                                'title' => '3.3 类的声明和创建内存分析2',
                                'url'   => 'http://www.tudou.com/l/_ZnZY_J94CY/&rpid=107340114&resourceId=107340114_04_05_99&iid=153346024/v.swf',
                            ),
                            array(
                                'title' => '3.4 @property属性和点语法',
                                'url'   => 'http://www.tudou.com/l/_ZnZY_J94CY/&rpid=107340114&resourceId=107340114_04_05_99&iid=153350397/v.swf',
                            ),
                            array(
                                'title' => '3.5 类的继承与重载',
                                'url'   => 'http://www.tudou.com/l/_ZnZY_J94CY/&rpid=107340114&resourceId=107340114_04_05_99&iid=153350409/v.swf',
                            ),
                            array(
                                'title' => '3.6 多态和动态绑定',
                                'url'   => 'http://www.tudou.com/l/_ZnZY_J94CY/&rpid=107340114&resourceId=107340114_04_05_99&iid=153350493/v.swf',
                            ),
                            array(
                                'title' => '3.7 动态绑定和异常处理',
                                'url'   => 'http://www.tudou.com/l/_ZnZY_J94CY/&rpid=107340114&resourceId=107340114_04_05_99&iid=153350496/v.swf',
                            ),
                        ),
                    ),
                    array(
                        'title' => '四、Cocoa Foundation 框架',
                        'class' => '',
                        'data'  => array(
                            array(
                                'title' => '4.1 NSNumber的使用',
                                'url'   => 'http://www.tudou.com/l/_ZnZY_J94CY/&rpid=107340114&resourceId=107340114_04_05_99&iid=153794897/v.swf',
                            ),
                            array(
                                'title' => '4.2 NSString字符串的使用',
                                'url'   => 'http://www.tudou.com/l/_ZnZY_J94CY/&rpid=107340114&resourceId=107340114_04_05_99&iid=153794898/v.swf',
                            ),
                            array(
                                'title' => '4.3 NSArray数组的使用',
                                'url'   => 'http://www.tudou.com/l/_ZnZY_J94CY/&resourceId=0_04_05_99&iid=153795084/v.swf',
                            ),
                            array(
                                'title' => '4.4 NSDictionary字典的使用',
                                'url'   => 'http://www.tudou.com/l/_ZnZY_J94CY/&rpid=31148191&resourceId=31148191_04_05_99&iid=153795428/v.swf',
                            ),
                            array(
                                'title' => '4.5 NSSet集合的使用',
                                'url'   => 'http://www.tudou.com/l/_ZnZY_J94CY/&rpid=31148191&resourceId=31148191_04_05_99&iid=153796432/v.swf',
                            ),
                        ),
                    ),
                    array(
                        'title' => '五、高级语法与设计模式',
                        'class' => '',
                        'data'  => array(
                            array(
                                'title' => '5.1 类目（Category）的基本概念和用法',
                                'url'   => 'http://www.tudou.com/l/_ZnZY_J94CY/&rpid=31148191&resourceId=31148191_04_05_99&iid=154205499/v.swf',
                            ),
                            array(
                                'title' => '5.2 延展的基本概念和用法 ',
                                'url'   => 'http://www.tudou.com/l/_ZnZY_J94CY/&resourceId=0_04_05_99&iid=154160288/v.swf',
                            ),
                            array(
                                'title' => '5.3 协议和代理设计模式基本概念 ',
                                'url'   => 'http://www.tudou.com/l/_ZnZY_J94CY/&resourceId=0_04_05_99&iid=154215669/v.swf',
                            ),
                            array(
                                'title' => '5.4 中介找房—代理设计模式 ',
                                'url'   => 'http://www.tudou.com/l/_ZnZY_J94CY/&resourceId=0_04_05_99&iid=154231562/v.swf',
                            ),
                        ),
                    ),
                    array(
                        'title' => '六、Objective-C 内存管理',
                        'class' => '',
                        'data'  => array(
                            array(
                                'title' => '6.1 引用技术的基本概念和用法',
                                'url'   => 'http://www.tudou.com/l/_ZnZY_J94CY/&resourceId=0_04_05_99&iid=154871960/v.swf',
                            ),
                            array(
                                'title' => '6.2 对象所有权的基本概念和用法 ',
                                'url'   => 'http://www.tudou.com/l/_ZnZY_J94CY/&resourceId=0_04_05_99&iid=154889843/v.swf',
                            ),
                            array(
                                'title' => '6.3 详解dealloc方法 ',
                                'url'   => 'http://www.tudou.com/l/_ZnZY_J94CY/&resourceId=0_04_05_99&iid=154871961/v.swf',
                            ),
                            array(
                                'title' => '6.4 点语法内存管理 ',
                                'url'   => 'http://www.tudou.com/l/_ZnZY_J94CY/&resourceId=0_04_05_99&iid=154871962/v.swf',
                            ),
                            array(
                                'title' => '6.5 自动释放池和ARC ',
                                'url'   => 'http://www.tudou.com/l/_ZnZY_J94CY/&resourceId=0_04_05_99&iid=154874602/v.swf',
                            ),
                            array(
                                'title' => '6.6 循环引用和总结 ',
                                'url'   => 'http://www.tudou.com/l/_ZnZY_J94CY/&resourceId=0_04_05_99&iid=154875552/v.swf',
                            ),
                        ),
                    ),
                    array(
                        'title' => '七、ONSFileHandle 的使用',
                        'class' => '',
                        'data'  => array(
                            array(
                                'title' => '7.1 NSFileHandle的概念和用法',
                                'url'   => 'http://www.tudou.com/v/SYMHM0OJqRk/&resourceId=0_04_05_99/v.swf',
                            ),
                            array(
                                'title' => '7.2 NSFileHandle作业1讲解',
                                'url'   => 'http://www.tudou.com/v/sVXqAtsvEVE/&rpid=31148191&resourceId=31148191_04_05_99/v.swf',
                            ),
                            array(
                                'title' => '7.3 NSFileHandle作业2讲解',
                                'url'   => 'http://www.tudou.com/v/Jqa0Y93Er1I/&rpid=31148191&resourceId=31148191_04_05_99/v.swf',
                            ),
                        ),
                    ),
                    array(
                        'title' => '八、Objective-C 对象进阶',
                        'class' => '',
                        'data'  => array(
                            array(
                                'title' => '8.1 赋值对象的概念和用法',
                                'url'   => 'http://www.tudou.com/v/402buQYyKEc/&resourceId=0_04_05_99/v.swf',
                            ),
                            array(
                                'title' => '8.2 复制对象课堂练习讲解',
                                'url'   => 'http://www.tudou.com/v/ggWu1W9z9xU/&rpid=31148191&resourceId=31148191_04_05_99/v.swf',
                            ),
                            array(
                                'title' => '8.3 归档的概念和用法',
                                'url'   => 'http://www.tudou.com/v/ToJ3eRwCrhY/&rpid=31148191&resourceId=31148191_04_05_99/v.swf',
                            ),
                            array(
                                'title' => '8.4 自定义对象的归档',
                                'url'   => 'http://www.tudou.com/v/158aiBbCUkw/&rpid=31148191&resourceId=31148191_04_05_99/v.swf',
                            ),
                        ),
                    ),
                ),
            ),
            array(
                'title' => 'DevDiv IOS 开发视频',
                'id'    => 'devdiv',
                'class' => '',
                'data'  => array(),
            ),

        );

        return $this->render('video', ['video' => $video]);
    }

    public function actionResource()
    {

        $type = Type::find()->where(['category' => 'file'])->all();

        $models = [];

        foreach ($type as $k => $v) {
            $model = File::find()->where(['category_id' => $v->id])
                ->orderBy('create_date', SORT_DESC)
                ->all();

            $models[$v->name] = $model;
        }

        return $this->render('resource', array(
            'models' => $models,
        ));
    }
}

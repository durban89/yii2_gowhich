<?php

namespace app\components;

use app\models\BlogCategory;
use yii\base\Widget;

class RightSidebarWidget extends Widget
{

    public function init()
    {
        parent::init();

    }

    public function run()
    {
        //文章分类
        $blogCategory = BlogCategory::find()->where(['is_deleted' => 0])->orderBy('id', 'DESC')->all();

        return $this->render('right_sidebar', compact('blogCategory'));
    }
}

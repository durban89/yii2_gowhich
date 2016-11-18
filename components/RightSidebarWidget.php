<?php

namespace app\components;

use app\models\Type;
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
        $blogCategory = Type::find()->where(['is_delete' => 0, 'category' => 'blog'])->orderBy('id', 'DESC')->all();

        return $this->render('right_sidebar', compact('blogCategory'));
    }
}

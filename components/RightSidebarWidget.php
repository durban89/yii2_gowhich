<?php

namespace app\components;

use yii\base\Widget;

class RightSidebarWidget extends Widget
{

    public function init()
    {
        parent::init();

    }

    public function run()
    {
        return $this->render('right_sidebar');
    }
}

<?php
namespace app\components;

use yii\base\Widget;

class StatCNZZWidget extends Widget
{

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        return $this->render('stat_cnzz');
    }
}

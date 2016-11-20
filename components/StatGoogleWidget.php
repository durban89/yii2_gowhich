<?php
namespace app\components;

use yii\base\Widget;

class StatGoogleWidget extends Widget
{

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        return $this->render('stat_google');
    }
}

<?php

namespace app\components;

use yii\base\Widget;

class TagWidget extends Widget
{
    public $tag;

    public function init()
    {
        parent::init();

    }

    public function run()
    {
        return $this->render('tag', ['tag' => $this->tag]);
    }
}

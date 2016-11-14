<?php

namespace app\components;

use yii\base\Widget;

class ArticleRowWidget extends Widget
{
    public $articles;

    public function init()
    {
        parent::init();

    }

    public function run()
    {
        return $this->render('article_row', ['articles' => $this->articles]);
    }
}

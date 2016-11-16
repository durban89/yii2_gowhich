<?php

namespace app\components;

use yii\base\Widget;

class ArticleWidget extends Widget
{
    public $article;
    public $prevArticle;
    public $nextArticle;

    public function init()
    {
        parent::init();

    }

    public function run()
    {
        return $this->render('article', [
            'article'     => $this->article,
            'prevArticle' => $this->prevArticle,
            'nextArticle' => $this->nextArticle,
        ]);
    }
}

<?php

namespace app\components;

use app\models\Blog;
use app\models\Type;
use yii\helpers\Html;
use yii\helpers\Url;

class Sitemap
{
    //public
    protected $rss_ver       = "2.0";
    protected $webSiteTitle  = '';
    protected $changefreq    = '';
    protected $content       = '';
    protected $priority      = '';
    protected $blogItems     = [];
    protected $tagItems      = [];
    protected $categoryItems = [];
    protected $items         = [];

    /**
     * 添加基本信息
     * @param string $title
     * @param string $link
     * @param string $description
     */
    public function __construct()
    {
        $this->webSiteTitle = 'http://' . $_SERVER['SERVER_NAME'];
        $this->changefreq   = 'daily'; //always hourly daily weekly monthly yearly never
        $this->priority     = 0.5;
    }

    /**
     * 分类
     */
    private function categorySitemap()
    {
        $model = Type::find()->where(['category' => 'blog'])
            ->orderBy('create_date', SORT_DESC)
            ->all();

        foreach ($model as $k => $v) {
            $this->categoryItems[] = array(
                'url'  => $this->webSiteTitle . Url::to(['category/view', 'category' => Html::encode(urlencode($v->name))]),
                'date' => date(DATE_W3C, strtotime($v->update_date)),
            );
        }
    }

    /**
     * 文章
     */
    private function blogSitemap()
    {
        $model = Blog::find()->select(['id', 'tag', 'update_date'])->where(['is_lock' => 0, 'is_delete' => 0])
            ->orderBy('create_date', SORT_DESC)
            ->all();

        foreach ($model as $k => $v) {
            $this->blogItems[] = array(
                'url'  => $this->webSiteTitle . Url::to(['site/view', 'id' => $v->id]),
                'date' => date(DATE_W3C, strtotime($v->update_date)),
            );

            $tagArr = preg_split('#,|，#i', $v->tag);

            if (!empty($tagArr)) {
                foreach ($tagArr as $k => $v) {
                    if (!in_array($v, $this->tagItems)) {
                        $this->tagItems[] = preg_replace('/\.php/', '', $v);
                    }
                }
            }
        }

        //创建临时函数数组
        $tmp            = array();
        $tmp            = $this->tagItems;
        $this->tagItems = array();
        foreach ($tmp as $k => $v) {
            $this->tagItems[] = array(
                'url'  => $this->webSiteTitle . Url::to(['tag/view', 'tag' => Html::encode(urlencode($v))]),
                'date' => date(DATE_W3C, time()),
            );
        }
        unset($tmp);
    }

    /**
     * 构建xml元素
     */
    public function buildSitemap()
    {
        $blogitem = '';
        foreach ($this->blogItems as $k => $v) {
            $blogitem .= <<<BLOG
            <url>\r\n
                <loc>{$v['url']}</loc>\r\n
                <lastmod>{$v['date']}</lastmod>\r\n
                <changefreq>{$this->changefreq}</changefreq>\r\n
                <priority>{$this->priority}</priority>\r\n
            </url>\r\n
BLOG;

        }

        $categoryitem = '';
        foreach ($this->categoryItems as $k => $v) {
            $categoryitem .= <<<BLOG
            <url>\r\n
                <loc>{$v['url']}</loc>\r\n
                <lastmod>{$v['date']}</lastmod>\r\n
                <changefreq>{$this->changefreq}</changefreq>\r\n
                <priority>{$this->priority}</priority>\r\n
            </url>\r\n
BLOG;

        }
        $tagitem = '';
        foreach ($this->tagItems as $k => $v) {
            $tagitem .= <<<BLOG
            <url>\r\n
                <loc>{$v['url']}</loc>\r\n
                <lastmod>{$v['date']}</lastmod>\r\n
                <changefreq>{$this->changefreq}</changefreq>\r\n
                <priority>{$this->priority}</priority>\r\n
            </url>\r\n
BLOG;

        }

        $this->content = <<<SITEMAP
<?xml version='1.0' encoding='UTF-8'?>\r\n
<?xml-stylesheet type="text/xsl" href="{$this->webSiteTitle}/sitemap.xsl"?>
<!-- generator="GoWhich/1.0" -->
<!-- sitemap-generator-url="{$this->webSiteTitle}" sitemap-generator-version="1.0.0" -->
<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"\r\n
        xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd"\r\n
        xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">\r\n
            {$blogitem}
            {$categoryitem}
            {$tagitem}
</urlset>\r\n
SITEMAP;
    }

    /**
     * 输出sitemap内容
     */
    public function show()
    {
        $this->blogSitemap();
        $this->categorySitemap();
        if (empty($this->content)) {
            $this->buildSitemap();
        }
        return $this->content;
    }

    /**
     * 将rss保存为文件
     * @param String $fname
     * @return boolean
     */
    public function saveToFile($fname)
    {
        $handle = fopen($fname, 'wb');
        if ($handle === false) {
            return false;
        }
        fwrite($handle, $this->content);
        fclose($handle);
    }

    /**
     * 获取文件的内容
     * @param String $fname
     * @return boolean
     */
    public function getFile($fname)
    {
        $handle = fopen($fname, 'r');
        if ($handle === false) {
            return false;
        }
        while (!feof($handle)) {
            echo fgets($handle);
        }
        fclose($handle);
    }
}

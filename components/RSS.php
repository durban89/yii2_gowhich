<?php

namespace app\components;

use yii\helpers\StringHelper;

class Rss
{
    //public
    public $rss_ver             = "2.0";
    public $channel_title       = '';
    public $channel_link        = '';
    public $channel_description = '';
    public $language            = 'zh-CN';
    public $copyright           = '';
    public $webMaster           = '';
    public $pubDate             = '';
    public $lastBuildDate       = '';
    public $generator           = 'GoWhich RSS Generator';
    public $content             = '';
    public $author              = '';
    public $items               = array();

    /**
     * 添加基本信息
     * @param string $title
     * @param string $link
     * @param string $description
     */
    public function __construct($title, $link, $description)
    {
        $this->channel_title       = $title;
        $this->channel_link        = $link;
        $this->channel_description = strip_tags($description);
        $this->pubDate             = Date('r', time());
        $this->lastBuildDate       = Date('r', time());
    }

    /**
     * 添加一个节点
     * @param string $title
     * @param string $link
     * @param string $description
     * @param date $pubDate
     * @param string $guid
     */
    public function addItem($title, $link, $content, $pubDate, $guid = '')
    {
        $this->items[] = array(
            'title'   => $title,
            'link'    => $link,
            'content' => preg_replace("#(&nbsp;)#i", " ", strip_tags((htmlspecialchars_decode($content)))),
            'pubDate' => $pubDate,
            'guid'    => $guid,
        );
    }

    /**
     * 构建xml元素
     */
    public function buildRSS()
    {
        $s = <<<RSS
<?xml version='1.0' encoding='utf-8'?>\n
<rss xmlns:content="http://purl.org/rss/1.0/modules/content/" xmlns:wfw="http://wellformedweb.org/CommentAPI/" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:atom="http://www.w3.org/2005/Atom" xmlns:sy="http://purl.org/rss/1.0/modules/syndication/" xmlns:slash="http://purl.org/rss/1.0/modules/slash/" version="2.0">\n
RSS;

        // start channel
        $s .= "<channel>\n";
        $s .= "<title><![CDATA[{$this->channel_title}]]></title>\n";
        $s .= "<atom:link href='{$this->channel_link}/feed' rel='self' type='application/rss+xml'/>\n";
        $s .= "<link><![CDATA[{$this->channel_link}]]></link>\n";
        $s .= "<description><![CDATA[{$this->channel_description}]]></description>\n";
        $s .= "<language>{$this->language}</language>\n";
        $s .= "<sy:updatePeriod>hourly</sy:updatePeriod>\n";
        $s .= "<sy:updateFrequency>1</sy:updateFrequency>\n";
        if (!empty($this->copyright)) {
            $s .= "<copyright><![CDATA[{$this->copyright}]]></copyright>\n";
        }
        if (!empty($this->webMaster)) {
            $s .= "<webMaster><![CDATA[{$this->webMaster}]]></webMaster>\n";
        }
        if (!empty($this->pubDate)) {
            $s .= "<pubDate>{$this->pubDate}</pubDate>\n";
        }
        if (!empty($this->lastBuildDate)) {
            $s .= "<lastBuildDate>{$this->lastBuildDate}</lastBuildDate>\n";
        }
        if (!empty($this->generator)) {
            $s .= "<generator>{$this->generator}</generator>\n";
        }

        // start items
        for ($i = 0; $i < count($this->items); $i++) {
            $description = StringHelper::truncate($this->items[$i]['content'], 200, true);
            $content     = $this->items[$i]['content'];
            $s .= "<item>\n";
            $s .= "<title><![CDATA[{$this->items[$i]['title']}]]></title>\n";
            $s .= "<link><![CDATA[{$this->items[$i]['link']}]]></link>\n";
            if (!empty($this->author)) {
                $s .= "<dc:creator>{$this->author}</dc:creator>\n";
            }
            $s .= "<description><![CDATA[{$description}]]></description>\n";
            $s .= "<content:encoded><![CDATA[{$content}]]></content:encoded>\n";
            $s .= "<pubDate>{$this->items[$i]['pubDate']}</pubDate>\n";
            $s .= "<guid isPermaLink='false'>{$this->items[$i]['guid']}</guid>\n";
            $s .= "</item>\n";
        }
        // close channel
        $s .= "</channel>\n</rss>";
        $this->content = $s;
    }

    /**
     * 输出rss内容
     */
    public function show()
    {
        if (empty($this->content)) {
            $this->buildRSS();
        }
        return $this->content;
    }

    public function setAuthor($author)
    {
        $this->author = $author;
    }

    /**
     * 设置版权
     * @param unknown $copyright
     */
    public function setCopyRight($copyright)
    {
        $this->copyright = $copyright;
    }

    /**
     * 设置管理员
     * @param unknown $master
     */
    public function setWebMaster($master)
    {
        $this->webMaster = $master;
    }

    /**
     * 设置发布时间
     * @param date $date
     */
    public function setpubDate($date)
    {
        $this->pubDate = $date;
    }

    /**
     * 设置建立时间
     * @param unknown $date
     */
    public function setLastBuildDate($date)
    {
        $this->lastBuildDate = $date;
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

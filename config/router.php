<?php

return [
    ''                        => 'site/index',
    'admin'                   => 'admin/site/login',
    'admin/logout'            => 'admin/site/logout',

    'blog'                    => 'site/index',
    'blog/<id:\d+>'           => 'site/view',
    'blog/view/id/<id:\d+>'   => 'site/view',
    'blog/view'               => 'site/view',
    'blog/<id:.*?>'           => 'site/view',
    'category'                => 'category/index',
    'category/<category:.*?>' => 'category/view',
    'tag'                     => 'tag/index',
    'tag/<tag:.*?>'           => 'tag/view',
    'search/'                 => 'search/index',
    'type/search/<id:\d+>'    => 'search/index',
    'author/<author:.*?>'     => 'author/view',
    'author'                  => 'author/index',

    'feed/'                   => 'site/feed',
    'sitemap.xsl/'            => 'site/sitemapxsl',
    'sitemap.xml/'            => 'site/sitemap',

    'video/'                  => 'site/video',
    'resource/'               => 'site/resource',

    '/<t:.*?>'                => 'site/index',
];

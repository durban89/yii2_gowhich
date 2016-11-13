<?php

namespace app\components;

use Yii;
use yii\base\Widget;
use yii\helpers\Url;

class HeaderWidget extends Widget
{

    public $nav          = [];
    public $controllerId = '';
    public $actionId     = '';
    private $mark        = [];

    private function setControllerId()
    {
        $this->controllerId = Yii::$app->controller->id;
    }

    private function setActionId()
    {
        $this->actionId = Yii::$app->controller->action->id;
    }

    private function setMark($mark)
    {
        $this->mark[] = $mark;
    }

    private function setNav()
    {
        $this->nav = [
            [
                'title'      => 'Home',
                'mark'       => 'home',
                'controller' => 'site',
                'action'     => 'index',
                'active'     => false,
                'link'       => Url::to(['site/index']),
            ],
            [
                'title'      => 'About Me',
                'mark'       => 'about',
                'controller' => 'site',
                'action'     => 'about',
                'active'     => false,
                'link'       => Url::to(['site/about']),
            ],
            [
                'title'      => 'Online Study',
                'mark'       => 'online_study',
                'controller' => 'site',
                'action'     => 'index',
                'link'       => '#',
                'active'     => false,
                'child'      => [
                    [
                        'title'      => 'iOS Video',
                        'mark'       => 'ios_video',
                        'rel_mark'   => 'online_study',
                        'controller' => 'site',
                        'action'     => 'video',
                        'active'     => false,
                        'link'       => Url::to(['site/video']),
                    ],
                    [
                        'title'      => 'Technical Books',
                        'mark'       => 'technical_books',
                        'rel_mark'   => 'online_study',
                        'controller' => 'site',
                        'action'     => 'resource',
                        'active'     => false,
                        'link'       => Url::to(['site/resource']),
                    ],
                ],
            ],
            [
                'title'      => 'Social Hub',
                'mark'       => 'social',
                'controller' => 'site',
                'action'     => 'social',
                'active'     => false,
                'link'       => Url::to(['site/social']),
            ],
            [
                'title'      => 'Quick Access',
                'mark'       => 'tools',
                'controller' => 'site',
                'action'     => 'tools',
                'active'     => false,
                'link'       => Url::to(['site/tools']),
            ],

        ];

    }

    private function setActive()
    {
        foreach ($this->nav as $k => $v) {
            if (isset($v['child'])) {
                foreach ($v['child'] as $ck => $cv) {
                    if (in_array($cv['mark'], $this->mark)) {
                        $this->nav[$k]['child'][$ck]['active'] = true;
                    }
                }

                if (in_array($v['mark'], $this->mark)) {
                    $this->nav[$k]['active'] = true;
                }
            } else {
                if (in_array($v['mark'], $this->mark)) {
                    $this->nav[$k]['active'] = true;
                }
            }
        }
    }

    private function getActiveMark($nav)
    {
        foreach ($nav as $k => $v) {
            if (isset($v['child'])) {
                $this->getActiveMark($v['child']);
            } else {
                if ($v['controller'] == $this->controllerId && $v['action'] == $this->actionId) {

                    $this->setMark($v['mark']);
                    if (isset($v['rel_mark'])) {
                        $this->setMark($v['rel_mark']);
                    }
                }
            }
        }
    }

    public function init()
    {
        parent::init();
        $this->setControllerId();
        $this->setActionId();
        $this->setNav();
        $this->getActiveMark($this->nav);

        $this->setActive();
    }

    public function run()
    {
        return $this->render('header', ['nav' => $this->nav]);
    }
}

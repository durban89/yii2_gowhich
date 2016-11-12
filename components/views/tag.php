<?php

use yii\helpers\Html;
use yii\helpers\Url;

$tagArr = [];
if (isset($tag)) {
    $tagArr = preg_split('#,|，#i', $tag);
}
?>

<?php if (count($tagArr)): ?>
<li class="meta-tags"> Tagged with
<?php foreach ($tagArr as $k => $v): ?>
<a href="<?=Url::to(['tag/view', 'tag' => Html::encode(urlencode($v))]);?>" rel="tag"><?=$v;?></a>
<?php if ($k + 1 != count($tagArr)): ?>
,
<?php endif;?>
<?php endforeach;?>
</li>

<?php endif;?>
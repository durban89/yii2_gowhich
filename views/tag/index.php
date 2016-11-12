<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;
?>

<header class="page-header">
    <h3>
        Tags
    </h3>

    <!-- <p>Category描述</p> -->

</header>

<?php if (isset($models) && count($models)): ?>
<div id="tags" class="widget widget_tags">
	<ul>
	    <?php foreach ($models as $v): ?>
		<li class="tag-item tag-item-<?=$v;?>" style='display: inline-block;margin: 5px'>
			<span class=" ">
				<a title='<?=Html::encode($v);?>' href="<?=Url::toRoute(['tag/view', 'tag' => Html::encode(urlencode($v))]);?>" ><?=$v;?></a>
			</span>
		</li>
	    <?php endforeach;?>
	</ul>
</div>
<?php endif;?>

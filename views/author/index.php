<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;
?>

<header class="page-header">
    <h3>
        Authors
    </h3>

    <!-- <p>Category描述</p> -->

</header>

<?php if (isset($models) && count($models)): ?>
<div id="categories" class="widget widget_categories">
	<ul>
	    <?php foreach ($models as $v): ?>
		<li class="author-item author-item-<?=$v->id;?>" style='display: inline-block;margin: 5px'>
			<span class=" ">
				<a title='<?=Html::encode($v->username);?>' href="<?=Url::toRoute(['author/view', 'author' => Html::encode(urlencode($v->username))]);?>" ><?=$v->username;?></a>
			</span>
		</li>
	    <?php endforeach;?>
	</ul>
</div>
<?php endif;?>

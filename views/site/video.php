<?php

use app\assets\FancyboxAsset;

$this->title = Yii::$app->params['title'] . '-' . Yii::$app->params['name']; //$this->params['name'];

FancyboxAsset::register($this);

?>

<div>
	<?php foreach ($video as $k => $v): ?>
		<section class='well'>
			<h4><?=$v['title'];?></h4>
			<div class='divider'></div>
			<?php if (!empty($v['data'])): ?>
				<?php foreach ($v['data'] as $v_key => $v_value): ?>
					<ul class='video-list'>
						<p><?=$v_value['title'];?></p>
						<?php foreach ($v_value['data'] as $data_key => $data_value): ?>
							<li>
								<a class="fancybox" id='video' href='<?php echo $data_value['url']; ?>'>
									<?=$data_value['title'];?>
								</a>
							</li>
						<?php endforeach;?>
					</ul>
				<?php endforeach;?>
			<?php else: ?>
				<div><h4 style='text-align:center'>暂时没有资源</h4></div>
			<?php endif;?>

			<div class='divider'></div>
		</section>
	<?php endforeach;?>
</div>
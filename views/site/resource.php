<div class='span12 left-container'>
<?php foreach ($models as $k => $v): ?>
	<section class='well'>
		<h4><?=$k;?>分类</h4>
		<div class='divider'></div>
		<?php if (empty($v)): ?>
			<div><h4 style='text-align:center'>暂时没有资源分享</h4></div>
		<?php else: ?>
		<div class='table'>
			<table class='table'>
                <thead>
                    <tr>
                        <td style='width:400px'>名称</td>
                        <td>总下载次数</td>
                        <td>最后发布时间</td>
                        <td>操作</td>
                    </tr>
                </thead>
				<tbody>
					<?php foreach ($v as $k_value => $v_value): ?>
                        <tr>
                            <td><?=$v_value->title;?></td>
                            <td><?=$v_value->download_sum;?>（次）</td>
                            <td><?=$v_value->update_date;?></td>
                            <td>
                                <a id="download-btn" target='_blank' href='<?=$v_value->url_address;?>'>下载</a>
                                <!-- <input type="hidden" name="download-id" value="<?=$v_value->id;?>"/> -->
                            </td>
                        </tr>
					<?php endforeach;?>
				</tbody>
			</table>
		</div>
		<?php endif;?>

	</section>
<?php endforeach;?>

</div>
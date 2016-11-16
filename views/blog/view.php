<?php

use app\components\ArticleWidget;

$this->title = $model->title . ' - ' . Yii::$app->params['name']; //$this->params['name'];

?>

<?=ArticleWidget::widget(['article' => $model, 'prevArticle' => $prev, 'nextArticle' => $next]);?>

<!-- JiaThis Button BEGIN -->

<div class="jiathis_style_32x32 share-icon-container">
  <a class="jiathis_button_tsina icon tsina"></a>
  <a class="jiathis_button_renren icon renren"></a>
  <a class="jiathis_button_douban icon douban"></a>
  <a class="jiathis_button_googleplus icon googleplus"></a>
  <a class="jiathis_button_fb icon fb"></a>
  <a class="jiathis_button_twitter icon twitter"></a>
  <a class="jiathis_button_linkedin icon linkedin"></a>
  <a class="jiathis_button_tieba icon tieba"></a>
</div>
<script type="text/javascript" >
var jiathis_config={
	data_track_clickback:true,
	summary:"",
	shortUrl:false,
	hideMore:true
}
</script>
<script type="text/javascript" src="http://v3.jiathis.com/code/jia.js?uid=1571129" charset="utf-8"></script>
<!-- JiaThis Button END -->

<div id="comments" class="comments-area">
	<!-- 评论插件 -->
	<div id="disqus_thread"></div>
	<script type="text/javascript">
	  /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
	  var disqus_shortname = 'gowhich'; // required: replace example with your forum shortname

	  /* * * DON'T EDIT BELOW THIS LINE * * */
	  (function() {
	    var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
	    dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
	    (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
	  })();
	</script>
	<noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
	<a href="http://disqus.com" class="dsq-brlink">comments powered by <span class="logo-disqus">Disqus</span></a>
</div>
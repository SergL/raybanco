<?php /*
  *
  * $news - новость
  *
  * */ ?><b class="clearb"></b>
<br />
<br />
<div id="path">
    <?php $this->widget('zii.widgets.CBreadcrumbs', array(
        'links'=>$this->breadcrumbs,
    )); ?>
</div>
<b class="clearb"></b>
<br />
<br />
<div class="dynamic_content">
<div id="page_title">

    <h3 class="float_left" category_id="32" tooltip="category"><?php echo $news->title; ?></h3>


</div>
<div id="news_main"><img src="<?php echo $news->getImageUrl('large'); ?>" border="0" align="left" style="margin: 0 15px 5px 0;"><?php echo $news->content; ?></div>
</div>
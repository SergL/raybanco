<?php /*
  *
  * $dataProvider - новости
  *
  * */ ?>



<?php $this->widget('zii.widgets.CBreadcrumbs', array(
    'links'=>$this->breadcrumbs,
)); ?>
<b class="clearb"></b>
<br />
<br />
<div class="content_r_head" style="border-top:1px solid #b2b2b2;margin:0;font-size:20px;"><em><b>СУПЕР НОВОСТИ</b></em></div>

<b class="clearb"></b>
<?php foreach($dataProvider->data as $news): ?>

<div class="dynamic_content">

    <h3>
        <a href="<?php echo $news->url; ?>">
            <?php echo Yii::app()->dateFormatter->format('dd MMMM y', $news->publish_date); ?>: 
            <?php echo $news->title; ?>
        </a>
    </h3>
    <p><img src="<?php echo $news->getImageUrl('small'); ?>" border="0" align="left" style="margin: 0 15px 5px 0;"></p>
    <p><?php echo $news->annotation; ?></p>
    <div class="clear"></div>

</div>
<?php endforeach; ?>

<div class="pagination">
<?php $this->widget('CLinkPager', array(
     'pages'=>$dataProvider->pagination,
)); ?>

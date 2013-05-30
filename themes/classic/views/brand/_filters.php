<form id="filter-form" action="<?php echo Yii::app()->createUrl('site/index'); ?>" method="get">
        <div class="content_l_head">Подбор по параметрам:</div>

        <span><a href="#">Бренд<img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/arrow-down.png" /></a></span>
        <?php $this->widget('Menu', array(
            'items'=>Brand::model()->rooted()->findAll(array('order'=>'name'))
        )); ?>

        <!--<span><a href="#">Категории<img src="<?php /*echo Yii::app()->theme->baseUrl; */?>/images/arrow-down.png" /></a></span>
        --><?php /*$this->widget('Menu', array(
            'items'=>Category::model()->rooted()->findAll()
        )); */?>



    <div class="social_like">

       <div class="like">
           <div id="vk_like"></div>
           <script type="text/javascript">
           VK.Widgets.Like("vk_like", {type: "full"});
           </script>
       </div>

    </div>

    <span><a href="<?php echo Yii::app()->createUrl('product/new'); ?>">Новинки<img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/arrow-down.png" /></a></span>
    <span><a href="#">Акции и скидки<img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/arrow-down.png" /></a></span>
        <ul>
            <li><a href="<?php echo Yii::app()->createUrl('product/hit'); ?>">Спецпредложения<img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/arrow-down.png" /></a></li>
            <li><a href="<?php echo Yii::app()->createUrl('news/archive'); ?>">Новости<img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/arrow-down.png" /></a></li>
        </ul>
    <span><a href="<?php echo Yii::app()->createUrl('product/promotion'); ?>">Аксессуары<img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/arrow-down.png" /></a></span>

</form>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl;?>/js/rochal-jQuery-slimScroll/slimScroll.js"></script>
<!--<link rel="stylesheet" type="text/css" href="<?php /*echo Yii::app()->theme->baseUrl;*/?>/js/scrollbars-master/jquery.scrollbars.css" media="all">-->
<script type="text/javascript">
    $(document).ready(function(){
        //$(".filter_category_l").scrollbars();
        //console.debug($('ul.filter_category_l').html());
        $('.filter_category_l').slimScroll({
            height: '310px',
            width: '200px',
            railVisible: true,
            alwaysVisible: true,
            color: '#000',
            size: '12px'
        });
    })

</script>
<style type="text/css">
    ul.filter_category_l{
        /*height: 250px;*/
    }
</style>

<form id="filter-form" action="<?php echo Yii::app()->createUrl('product/index'); ?>" method="get">
            <div class="content_l_head">Подбор по параметрам:</div>

            <span>Солнцезащитные очки<img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/arrow-down.png" /></span>
    <div class="clearb"></div>
    <div class="scroll_container" style="margin: 10px 0 0;">
            <ul class="filter_category_l">
                <li><a href="<?php echo Yii::app()->createUrl('category/view', array('id'=>1)); ?>">Все</a></li>
                <?php foreach(Brand::model()->rooted()->findAll(array('order'=>'name')) as $brand): ?>
                <li <?php if($brand->id==@$_GET['Product']['brand_id']) echo 'class="active-brand"'; ?>  >
                    <a href="<?php echo Yii::app()->createUrl('category/view', array('id'=>1, 'Product'=>array('brand_id'=>$brand->id))); ?>"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/pic/checkbox1.png"> <?php echo $brand->name; ?></a>
                </li>

                <?php endforeach; ?>
            </ul>
    </div>
            <span>Оправы<img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/arrow-down.png" /></span>
            <ul>
                <li><a href="<?php echo Yii::app()->createUrl('category/view', array('id'=>2)); ?>">Все</a></li>
            </ul>

            <div class="social_like">

                <div id="vk_like"></div>
                <script type="text/javascript">
                    VK.Widgets.Like("vk_like", {type: "button", verb: 1, height: 18});
                </script>

            </div>

            <span><a href="<?php echo Yii::app()->createUrl('product/new'); ?>">Новинки<img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/arrow-down.png" /></a></span>
            <span>Акции и скидки<img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/arrow-down.png" /></span>
                <ul>
                    <li><a href="<?php echo Yii::app()->createUrl('product/hit'); ?>">Спецпредложения<img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/arrow-down.png" /></a></li>
                    <li><a href="<?php echo Yii::app()->createUrl('news/archive'); ?>">Новости<img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/arrow-down.png" /></a></li>
                </ul>
            <span><a href="<?php echo Yii::app()->createUrl('category/view', array('id'=>5)); ?>">Аксессуары<img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/arrow-down.png" /></a></span>

        </form>



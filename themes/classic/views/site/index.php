<?php
Yii::app()->getClientScript()->registerScript('MzSlider', "
    $('.slider_buttons a').click(function(){
        var index =$(this).index()+0;
        $('.slider_buttons a').removeClass('cur');
        $(this).addClass('cur');
        $('.slider .slider_pic ul').animate({
            left:'-'+(index*1010)+'px'
        });
        return false;
    });
    $('.slider_buttons a:first').click();


    setInterval(function(){
        if($('.slider').is(':hover')) return;

        var el=$('.slider_buttons a.cur').next();
        if(el.length) {
            el.click();
        } else {
            $('.slider_buttons a:first').click();
        }
        //console.debug(el);
    }, 4000);
");
?>
<div class="slider">
        <?php /*$this->widget('MzSlider', array(
            'width'=>'1010',
            'height'=>'350',
            'items'=>$this->getScrapItems('Главный слайдер'),
            'slideExpression'=>'$data->renderTemplate();',
            'template'=>'<div class="slider_pic">{content}</div><a href="#"><div class="slider_previous"></div></a><a href="#"><div class="slider_next"></div></a>',
        ));*/ ?>

<?php $this->widget('CodaSlider', array(
    'items'=>$this->getScrapItems('Главный слайдер'),
    'options'=>array(
        'autoSlide'=>true,
        'autoSlideInterval'=>4000
    ),
)); ?>

</div>


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


<div class="content">
    <div class="content_l">
        <form id="filter-form" action="<?php echo Yii::app()->createUrl('product/index'); ?>" method="get">
        <div class="content_l_head">Подбор по параметрам:</div>


        <span>Солнцезащитные очки<img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/arrow-down.png" alt="стрелочка вниз" /></span>
        <div class="clearb"></div>
        <div class="scroll_container" style="margin: 10px 0 0;">
        <ul class="filter_category_l">
            <li><a href="<?php echo Yii::app()->createUrl('category/view', array('id'=>1)); ?>">Все</a></li>
            <?php foreach(Brand::model()->rooted()->findAll(array('order'=>'name')) as $brand): ?>
            <li <?php if($brand->id==@$_GET['Product']['brand_id']) echo 'class="active-brand"'; ?> >
                <a href="<?php echo Yii::app()->createUrl('category/view', array('id'=>1, 'Product'=>array('brand_id'=>$brand->id))); ?>"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/pic/checkbox1.png" alt="чекбоксик"/> <?php echo $brand->name; ?></a>
            </li>
            <?php endforeach; ?>
        </ul>
        </div>

        <span>Оправы<img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/arrow-down.png" alt="стрелочка вниз" /></span>
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
            <span>Акции и скидки<img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/arrow-down.png"  alt="Акции и скидки"/></span>
                <ul>
                    <li><a href="<?php echo Yii::app()->createUrl('product/hit'); ?>">Спецпредложения<img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/arrow-down.png" alt="Спецпредложения"/></a></li>
                    <li><a href="<?php echo Yii::app()->createUrl('news/archive'); ?>">Новости<img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/arrow-down.png" alt="Новости"/></a></li>
                </ul>
            <span><a href="<?php echo Yii::app()->createUrl('category/view', array('id'=>5)); ?>">Аксессуары<img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/arrow-down.png" alt="Аксессуары" /></a></span>
        </form>
    </div>
    <div class="content_c">
        <em><b>ХИТ ПРОДАЖ</b></em>
        <?php foreach($dataProvider->data as $product): ?>
            <?php $this->renderPartial('/product/_view', array('product'=>$product)); ?>
        <?php endforeach; ?>

        <div class="pagination">
        <?php $this->widget('CLinkPager', array(
             'pages'=>$dataProvider->pagination,
            /*'lastPageLabel'=>'',
            'firstPageLabel'=>'',*/
            'prevPageLabel'=>'НАЗАД',
            'nextPageLabel'=>'ВПЕРЕД',
        )); ?>
        </div>

        <div class="plugin_facebook">
           <!-- VK Widget -->
<div id="vk_groups"></div>
<script type="text/javascript">
VK.Widgets.Group("vk_groups", {mode: 0, width: "700", height: "290"}, 15399961);
</script>
        </div>
    </div>
</div>
<div class="site_text">
<?php echo Yii::app()->config['main_text']; ?>
</div>
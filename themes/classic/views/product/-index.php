<?php
$this->layout='//layouts/main';
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
        console.debug(el);
    }, 3000);
");
?>
<div class="slider">
        <?php $this->widget('MzSlider', array(
            'width'=>'1010',
            'height'=>'355',
            'items'=>$this->getScrapItems('Главный слайдер'),
            'slideExpression'=>'$data->renderTemplate();',
            'template'=>'<div class="slider_pic">{content}</div><div class="slider_buttons"><ul><li>{navigation}</li></ul></div>',
        )); ?>
</div>
<div class="content">
    <div class="content_l">
        <form action="<?php echo Yii::app()->createUrl('product/index'); ?>" method="get">
        <span><b>Подбор по параметрам:</b></span>
        <span><a href="#">Категории<img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/arrow-down.png" /></a></span>
        <?php $this->widget('Menu', array(
            'items'=>Category::model()->findAll()
        )); ?>
        <span><a href="#">Бренд<img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/arrow-down.png" /></a></span>
        <ul>
            <?php foreach(Brand::model()->findAll() as $brand): ?>
            <li><img src="<?php echo Yii::app()->theme->baseUrl; ?>/pic/checkbox2.png"> <?php echo $brand->name; ?></li>
            <?php endforeach; ?>
        </ul>
        <span><a href="#">Покрытие<img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/arrow-down.png" /></a></span>
        <ul>
            <?php foreach(Product::model()->getCoveringList() as $key=>$value): ?>
            <li><img src="<?php echo Yii::app()->theme->baseUrl; ?>/pic/checkbox2.png"> <?php echo $value; ?></li>
            <?php endforeach; ?>
        </ul>

        <span><a href="#">Цена<img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/arrow-down.png" /></a></span>
        <div class="filters gradient">
<?php

            $from=isset($_GET['Product']['price']['from'])?$_GET['Product']['price']['from']:0;
            $till=isset($_GET['Product']['price']['till'])?$_GET['Product']['price']['till']:20000;
            $fieldName='Product[price]';

            $idFrom=CHtml::getIdByName($fieldName.'[from]');
            $idTill=CHtml::getIdByName($fieldName.'[till]');
            $id=CHtml::getIdByName($fieldName);
            $field=Yii::app()->controller->widget('zii.widgets.jui.CJuiSlider', array(
                'options'=>array(
                    'range'=>true,
                    'min'=>0,
                    'max'=>20000,
                    'values'=>array($from, $till),
                    'slide'=>"js:function(event, ui){
                        $('#$idFrom').val(ui.values[0]);
                        $('#$idTill').val(ui.values[1]);
                    }",
                ),
                'htmlOptions'=>array(
                    'id'=>$id,
                )
            ),true);
            $field.='от ';
            $field.=CHtml::textField($fieldName.'[from]', $from, array(
                'size'=>5,
                'maxlength'=>strlen(20000),
                'onchange'=>"$('#$id').slider('values', [$('#$idFrom').val(), $('#$idTill').val()])",
            ));
            $field.=' до ';
            $field.=CHtml::textField($fieldName.'[till]', $till, array(
                'size'=>5,
                'maxlength'=>strlen(20000),
                'onchange'=>"$('#$id').slider('values', [$('#$idFrom').val(), $('#$idTill').val()])",
                'style'=>'width:35px;',
            ));
            $field.=' грн.';
            $field.='<button type="submit"></button>';
            echo $field;
?>
        </div>

        <span class="akcii"><a href="#">Акции и скидки<img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/arrow-down.png" /></a></span>
            <ul>
               <li><a href="#">Спецпредложения</a></li>
               <li><a href="#">Новости</a></li>
           </ul>
        </form>
    </div>
    <div class="content_c">
        <em><b>Каталог товаров</b></em>

        <?php foreach($dataProvider->data as $product): ?>
            <?php $this->renderPartial('/product/_view', array('product'=>$product)); ?>
        <?php endforeach; ?>


        <b class="clearb"></b>

        <?php $this->widget('CLinkPager', array(
             'pages'=>$dataProvider->pagination,
        )); ?>

        <div class="articles_head_bg">
            <div class="articles_head">
            ИНТЕРНЕТ ГЛЯНЕЦ
            </div>
        </div>
        <div class="articles">
            <?php foreach(News::model()->limit(2)->last()->findAll() as $i=>$news_item): ?>
            <div class="articles_item <?php if($i==1) echo ' nomargin';?>">
                <div class="articles_item_pic">
                    <a href="<?php echo $news_item->url; ?>"><img src="<?php echo $news_item->getImageUrl('small'); ?>" /></a>
                </div>
                <div class="articles_item_pic_text">
                <?php echo Yii::app()->dateFormatter->format('dd MMMM y', $news_item->publish_date); ?>
                </div>
                <div class="articles_item_head">
                    <a href="<?php echo $news_item->url; ?>"><?php echo $news_item->title; ?></a>
                </div>
                <div class="articles_item_text">
                    <?php echo $news_item->annotation; ?>
                </div>
            </div>
            <?php endforeach; ?>

            <div class="articles_button">
                <a href="<?php echo Yii::app()->createUrl('news/archive'); ?>"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/articles_button.png" /></a>
            </div>
        </div>
    </div>
    <div class="content_r">
        <em><b>НОВИНКИ</b></em>
        <?php foreach(Product::model()->novelties()->limit(6)->findAll() as $product): ?>
        <a href="<?php echo $product->url; ?>"><div class="content_r_item">
            <div class="content_r_item_pic">
                <img src="<?php echo $product->getImageUrl('small'); ?>" />
            </div>
            <div class="content_r_item_bg">
                <?php echo Yii::app()->priceFormatter->templateFormat('<p>{price}</p><span><p>{currency}</p></span>', $product->price); ?>
            </div>
        </div></a>
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
    </div>
</div>
<div class="site_text">
<?php echo Yii::app()->config['main_text']; ?>
</div>
        <form id="filter-form" action="<?php echo Yii::app()->createUrl('product/index'); ?>" method="get">
            <div class="content_l_head">Подбор по параметрам:</div>

            <span><a href="#">Солнцезащитные очки<img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/arrow-down.png" /></a></span>
            <ul>
                <li><a href="<?php echo Yii::app()->createUrl('category/view', array('id'=>1)); ?>">Все</a></li>
                <?php foreach(Brand::model()->findAll() as $brand): ?>
                <li <?php if(@in_array($brand->id, $_GET['Product']['brand_id'])) echo 'style="display:none;"'; ?>  ><img src="<?php echo Yii::app()->theme->baseUrl; ?>/pic/checkbox1.png"> <label><?php echo CHtml::checkBox('Product[brand_id]['.$brand->id.']', @in_array($brand->id, $_GET['Product']['brand_id']), array('value'=>$brand->id, 'style'=>'display:none;', 'onchange'=>"$('#filter-form').submit();"))?> <?php echo $brand->name; ?></label></li>
                <?php endforeach; ?>
            </ul>

            <span><a href="#">Оправы<img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/arrow-down.png" /></a></span>
            <ul>
                <li><a href="<?php echo Yii::app()->createUrl('category/view', array('id'=>2)); ?>">Все</a></li>
            </ul>





            <div class="social_like">

                <div class="like">
                    <div class="fb-like" data-send="false" data-layout="button_count" data-width="450" data-show-faces="true"></div>
                </div>

            </div>

            <span><a href="<?php echo Yii::app()->createUrl('product/new'); ?>">Новинки<img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/arrow-down.png" /></a></span>
            <span><a href="<?php echo Yii::app()->createUrl('product/promotion'); ?>">Акции и скидки<img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/arrow-down.png" /></a></span>
                <ul>
                    <li><a href="<?php echo Yii::app()->createUrl('product/hit'); ?>">Спецпредложения<img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/arrow-down.png" /></a></li>
                    <li><a href="<?php echo Yii::app()->createUrl('news/archive'); ?>">Новости<img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/arrow-down.png" /></a></li>
                </ul>
            <span><a href="<?php echo Yii::app()->createUrl('product/promotion'); ?>">Аксессуары<img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/arrow-down.png" /></a></span>

        </form>



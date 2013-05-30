<?php
Yii::app()->getClientScript()->registerScript('MzSlider', "
    $('.more_pics').click(function(){

        var index =$(this).index()+0;
        $('.more_pic ul').animate({
            left:'-'+(index*355)+'px'
        });


        $('.more_pics').removeClass('current-image');
        $(this).addClass('current-image');
        return false;
    });

    $('.more_pic_left').click(function(){



        var el=$('.current-image').prev();
        if(el.length) {
            el.click();
        } else {
            $('.more_pics:last').click();
        }
        return false;
    })

    $('.more_pic_right').click(function(){
        var el=$('.current-image').next();
        if(el.length) {
            el.click();
        } else {
            $('.more_pics:first').click();
        }

        return false;

    })
");

?>

<?php $this->layout='column1'; ?>
<div class="product-head"><br />
<br />

<?php $this->widget('zii.widgets.CBreadcrumbs', array(
    'links'=>$this->breadcrumbs,
)); ?>

<?php if($product->hasAccessories): ?>
    <div class="recommend_head">
    Аксессуары:
    </div>
<?php endif; ?>
</div>

<b class="clearb"></b>
<div class="more">
    <div class="more_l">
        <div class="more_pics_wrapper">
            <div class="product_status_icon">
                <?php if($product->novelty): ?>
                    <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/ray1.png" />
                <?php endif; ?>
                <?php if($product->hit): ?>
                    <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/ray2.png" />
                <?php endif; ?>
                <?php if($product->shopwindow): ?>
                    <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/ray3.png" />
                <?php endif; ?>
            </div>
            <div class="more_pic_wrapper">
                <div class="more_pic">
                    <?php $this->beginWidget('PrettyPhoto', array(
                        'gallery'=>true,
                        'options'=>array(
                            'overlay_gallery'=>true,
                        )
                    )); ?>

                    <?php $this->widget('MzSlider', array(
                        'width'=>'355',
                        'height'=>'235',
                        'itemView'=>'_slider',
                        'items'=>CMap::mergeArray(array($product),$product->images),
                        'viewData'=>array('product'=>$product),
                        'template'=>'{content}',
                    )); ?>

                    <?php $this->endWidget(); ?>
                </div>

                <!--<script type="text/javascript">
                    $(document).ready(function() {
                        $(".fancybox-thumb").fancybox({
                            prevEffect	: 'none',
                            nextEffect	: 'none',
                            helpers	: {
                                title	: {
                                    type: 'outside'
                                },
                                thumbs	: {
                                    width	: 100,
                                    height	: 100
                                }
                            }
                        });
                    });
                </script>-->

            </div>
            <?php $this->beginWidget('PrettyPhoto', array(
                'gallery'=>true
            )); ?>
            <?php $this->endWidget(); ?>
            <div class="more_pics_small">
                <div class="more_pics current-image">
                    <a href="<?php echo $product->getImageUrl('verylarge'); ?>"><img src="<?php echo $product->getImageUrl('small'); ?>" /></a>
                </div>
                <?php foreach($product->images as $image): ?>
                <div class="more_pics">
                    <a href="<?php echo $image->getImageUrl('verylarge'); ?>"><img src="<?php echo $image->getImageUrl('small'); ?>" /></a>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="more_info">
            <div class="more_name">
                <?php echo $product->getFullnameDetail(); ?>
            </div>
            <div class="more_price">
                <?php echo Yii::app()->priceFormatter->templateFormat('{int}<sup>{pense}</sup><span>{currency}</span>', $product->price); ?>
            </div>

            <div class="old_price">
            <?php if($product->other_price): ?>
                <?php echo Yii::app()->priceFormatter->templateFormat('<i>{int}</i><sup>{pense}</sup><span>{currency}</span>', $product->other_price); ?>
            <?php endif; ?>
            </div>
            <div class="more_number">
              
                <?php if($product->status==Product::STATUS_ABSENT): ?>
                <!--<span style="color:#0094B3;">Временно нет в наличии</span>-->
                <?php else: ?>
                  <strong>Количество:</strong> <input id="product-cart-quantity" type="text" value="1" />
                <span>Есть в наличии</span>
                <?php endif; ?>
            </div>
            <div class="more_buttons">
                <?php if($product->status==Product::STATUS_ABSENT): ?>

                <a href="#" style="margin-top: -59px;"><img style="margin-top: -59px;" src="<?php echo Yii::app()->theme->baseUrl; ?>/images/nema-v-nalichiii.png" /></a>
                <?php else: ?>
                <a href="#" onclick="$.putToCart(<?php echo $product->id?>, '#product-cart-quantity')"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/add_to_cart_button.png" /></a>
                <a href="#" onclick="$.putToCart(<?php echo $product->id?>, '#product-cart-quantity', function(){window.location='<?php echo Yii::app()->createUrl('order/index'); ?>';}); "><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/form_order_button.png" /></a>
                <?php endif; ?>
            </div>
            <b class="clearb"></b>
            <div class="yiiTab">
                <div class="description_head">Описание и характеристики</div>
           <div class="more-descr"> <?php echo $product->description; ?></div><br>

              <div class="more-feature">  <?php foreach($product->getFeatures(Feature::IN_DETAIL) as $i=>$feature): ?>
                <p <?php if($i%2) echo 'class="feature_block"'; ?>><?php echo $feature->name; ?>: <?php echo $feature->value; ?></p>
                <?php endforeach; ?></div>

            </div>



            <div class="more_icons">
                <?php foreach($product->getFeatures(Feature::IN_COMPARE) as $feature): ?>
                <?php if($feature->value=='да' || $feature->value=='Да'): ?>
                    <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/<?php echo $feature->alowed_values; ?>" />
                <?php endif; ?>
                <?php endforeach; ?>
            </div>

            <div class="social_like2">





                <div class="like google">
                <!-- Поместите этот тег туда, где должна отображаться кнопка +1. -->
                <g:plusone></g:plusone>

                <!-- Поместите этот вызов функции отображения в соответствующее место. -->
                <script type="text/javascript">
                  (function() {
                    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
                    po.src = 'https://apis.google.com/js/plusone.js';
                    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
                  })();
                </script>
                </div>

                             <div class="like">
                                <div class="fb-like" data-send="false" data-layout="button_count" data-width="450" data-show-faces="true"></div>
                            </div>

                <div class="like" style="width: 240px;">
                    <div id="vk_like"></div>
                    <script type="text/javascript">
                        VK.Widgets.Like("vk_like", {type: "full"});
                    </script>
                </div>
                        </div>
        </div>
    </div>
    <?php if($product->hasAccessories): ?>
    <div class="more_r">
        <?php foreach($product->accessories as $accessory): ?>
        <div class="more_r_item">
            <div class="more_r_item_pic">
                <a href="<?php echo $accessory->url; ?>"><img width="139" src="<?php echo $accessory->getImageUrl('small'); ?>" /></a>
            </div>
            <div class="more_r_item_name">
                <a href="<?php echo $accessory->url; ?>"><?php echo $accessory->name; ?></a>
            </div>
            <div class="more_r_item_price">
                <?php echo Yii::app()->priceFormatter->format($accessory->price); ?>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
</div>
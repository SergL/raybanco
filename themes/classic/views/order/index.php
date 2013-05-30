<?php
Yii::app()->getClientScript()->registerScript('delivery-payment', "

    $('.deliver_item input').change(function(){
        var el=$(this);
        var price=el.parent().parent().attr('price');
        var delivery_price=el.parent().parent().attr('delivery-price');
        $('#subtotal_price').text(price);
        $('#delivery_price').text(delivery_price);
        $('#order-form #Order_delivery_id').val(el.val());
    });


    /*$('.deliver_item input').change();*/
");
?>
<div class="korzina">
        	<div class="korzina_head">
            	<span>Оформление заказа</span>
            </div>

<?php if(Yii::app()->user->isGuest): ?>
            <div class="korzina_menu">
            	<ul>
                	<li class="active"><a href="#">Новый покупатель</a></li>
                    <li><a href="<?php echo Yii::app()->createUrl('site/login', array('return_url'=>Yii::app()->request->pathInfo)); ?>">Я зарегистрирован</a></li>
                </ul>
            </div>
<?php endif; ?>
    <?php $form=$this->beginWidget('CActiveForm', array(
    	'id'=>'order-form',
        'action'=>$this->createUrl('index'),
    )); ?>
            <div class="korzina_l">
            	<div class="korzina_l_head">
                Ваши данные:
                </div>
                <div class="korzina_input">
                	<div class="korzina_input_head">
                        <?php echo $form->labelEx($order, 'name'); ?>
                    </div>
                    <?php echo $form->textField($order, 'name'); ?>
                    <?php echo $form->error($order, 'name'); ?>
                </div>
                <div class="korzina_input">
                	<div class="korzina_input_head">
                        <?php echo $form->labelEx($order, 'phone'); ?>
                    </div>
                    <?php echo $form->textField($order, 'phone'); ?>
                    <?php echo $form->error($order, 'phone'); ?>
                </div>
                <div class="korzina_input">
                	<div class="korzina_input_head">
                        <?php echo $form->labelEx($order, 'email'); ?>
                    </div>
                    <?php echo $form->textField($order, 'email'); ?>
                    <?php echo $form->error($order, 'email'); ?>
                </div>
                <div class="korzina_input">
                	<div class="korzina_input_head">
                        <?php echo $form->labelEx($order, 'address'); ?>
                        <a class="more-info-link fancybox.ajax" href="<?php echo Yii::app()->createUrl('article/aview', array('id'=>18)); ?>">подробнее</a>
                    </div>
                    <?php echo $form->textArea($order, 'address'); ?>
                    <?php echo $form->error($order, 'address', array('style'=>'width:325px;')); ?>
                </div>
                <div class="korzina_input">
                	<div class="korzina_input_head">
                        <?php echo $form->labelEx($order, 'comment'); ?>
                    </div>
                    <?php echo $form->textArea($order, 'comment', array('style'=>'width:200px;')); ?>
                    <?php echo $form->error($order, 'comment', array('style'=>'width:325px;')); ?>
                </div>
            </div>
    <?php echo CHtml::activeHiddenField($order, 'delivery_id'); ?>

            <div class="korzina_r">
            	<div class="korzina_l_head" style="margin-bottom:0;">
                Ваша корзина:
                </div>
                <div class="korzina_items">
                    <table style="margin:0;">
<?php foreach(Yii::app()->cart->products as $i=>$product): ?>
                        <tr style="border-top:none; border-color:#e5e5e5;">
                            <td class="korzina_pic"><img width="139" src="<?php echo $product->getImageUrl('small'); ?>"></td>
                            <td>
                                <a style="color:#333333; font-size:12px; font-family:Georgia, 'Times New Roman', Times, serif;" href="<?php echo $product->url; ?>"><?php echo $product->name; ?></a>
                            </td>
                            <td>
                                <?php echo $form->textField($product, "[$i]quantity", array('class'=>'cart-quantity')); ?>
                                <b class="clearb"></b>
                                <a style="font-size:11px; font-family:Arial, Helvetica, sans-serif; color:#666; text-decoration:none;" href="#" onclick="$('#products-form').submit();return false;">ОБНОВИТЬ</a>
                            </td>
                            <td style="min-width:100px;">
                                <strong style="font-size:17px;"><?php echo Yii::app()->priceFormatter->format($product->sumPrice); ?></strong>
                                <b class="clearb"></b>
                                <a style="font-size:14px; color:#1a1a1a;" href="<?php echo $this->createUrl('remove', array('id'=>$product->id)); ?>">Удалить</a>
                            </td>
                        </tr>
<?php endforeach; ?>
                    </table>
                </div>
                <div class="deliver">
                	<div class="deliver_head">
                    	Оплата и доставка:
                    </div>
<?php foreach(Delivery::model()->findAll() as $delivery): ?>
                    <div class="deliver_item" delivery-price="<?php echo Yii::app()->priceFormatter->format($delivery->priceTo(Yii::app()->cart->cost)); ?>" price="<?php echo Yii::app()->priceFormatter->format(Yii::app()->cart->cost+$delivery->priceTo(Yii::app()->cart->cost)); ?>">
                    	<label><?php echo CHtml::activeRadioButton($order, 'delivery_id', array('value'=>$delivery->id, 'uncheckValue'=>null/*, 'checked'=>Yii::app()->user->getState('delivery')==$delivery->id*/, 'class'=>'delivery_id')); ?>
                        <div class="deliver_text">
                        	<p><?php echo $delivery->name; ?> (<?php echo Yii::app()->priceFormatter->format($delivery->price); ?>)
                                <a href="#more-delivery-<?php echo $delivery->id; ?>" class="info_icon more-info-link"></a>
                            <p><span><?php echo $delivery->description; ?></span></p>
                        </div></label>
                    </div>

<div style="display: none;">
    <div id="more-delivery-<?php echo $delivery->id; ?>">
        <?php echo $delivery->description2; ?>
    </div>
</div>

<?php endforeach; ?>

                    <?php echo $form->error($order, 'delivery_id', array('style'=>'width:325px;margin-top:10px;')); ?>


                </div>
                <div class="kupon" style="margin:20px 0 0; width:100%;">
                    <div class="kupon_head">
                    Код купона на скидку
                    </div>
                    <?php echo CHtml::hiddenField('Order[delivery]', Yii::app()->user->getState('delivery'));?>
                    <input style="border:1px solid #e5e5e5; background:#fff; width:150px;" type="text" name="coupon" value="<?php echo @$_POST['coupon']; ?>" />
                    <input style="background:#e9e9e9; border:1px solid #999999; height:28px; margin:10px 0 0 15px; cursor:pointer; padding:0 10px; font-size:12px; font-weight:bold; color:#4d4d4d;" type="submit" value="ПРИМЕНИТЬ" />
                    <?php $this->endWidget(); ?>
                </div>
                <div class="korzina_total" style="margin:40px 0 0; width:250px;">
                    <table>
                    	<tr>
                        	<td>ИТОГО:</td>
                            <td><?php echo Yii::app()->priceFormatter->format(Yii::app()->cart->getCost(false)); ?></td>
                        </tr>
                        <tr>
                        	<td>ДОСТАВКА:</td>
                            <td><span id="delivery_price"><?php echo isset($order->delivery->price)?$order->delivery->price:0;?> грн.</span></td>
                        </tr>
                        <tr>
                        	<td style="min-width:180px; font-size:19px; color:#000; padding:10px 0 0 5px;">ИТОГО К ОПЛАТЕ:</td>
                            <?php $deliveryPrice=$order->delivery?$order->delivery->priceTo(Yii::app()->cart->cost):0; ?>
                            <td style="font-size:18px; color:#000;padding:10px 0 0 5px;"><span id="subtotal_price"><?php echo Yii::app()->priceFormatter->format(Yii::app()->cart->cost+$deliveryPrice); ?></span></td>
                        </tr>
                    </table>
                </div>
                <div class="korzina_order" style="margin:65px 70px 0 0;">
                    <?php echo CHtml::submitButton('Подтвердить заказ', array('name'=>'Order[submit]', 'style'=>'background: #000;color: #fff;padding: 9px 15px;border: none;border-radius: 10px;font-size: 14px;font-weight: bold;'));?>
                    <!--<a href="#" onclick="$('#order-form').submit();">
                        <img src="<?php /*echo Yii::app()->theme->baseUrl; */?>/images/form_order_button2.png" />
                    </a>-->
                </div>
            </div>

        </div>
<script type="text/javascript">
    $('.delivery_id').change(function(){
        $('#Order_delivery').val($(this).val());
    })
    $('.cart-quantity').change(function(){
        $('#order-form').submit();
    })
</script>
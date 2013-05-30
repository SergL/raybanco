<?php if(isset($_GET['show_user_menu'])):?>
<div class="blog_l">
    <?php $this->renderPartial('/user/_left'); ?>
</div>
<?php endif;?>

<div class="korzina" <?php if(isset($_GET['show_user_menu'])):?>style="float: left; width: 720px; margin-left: 80px;"<?php endif;?>>
    <div class="dynamic_head article_short_head">
        <span>Ваша корзина</span>
    </div>
    <div class="korzina_items">
        <?php
        $form=$this->beginWidget('CActiveForm', array(
        	'id'=>'products-form',
            'action'=>$this->createUrl('order/update', array('return_url'=>Yii::app()->request->hostInfo.Yii::app()->request->url))
        )); ?>

        <?php echo CHtml::hiddenField('returnUrl', $this->createUrl('order/book'))?>

        <table style="margin-top: 15px;">
            <tr style="border-top:0px;">
                <th></th>
                <th>ОПИСАНИЕ ТОВАРА</th>
                <th>ЦЕНА</th>
                <th>КОЛИЧЕСТВО</th>
                <th>ИТОГО</th>
            </tr>
<?php foreach(Yii::app()->cart->products as $i=>$product): ?>
            <tr>
                <td class="korzina_pic">
                    <img width="139" src="<?php echo $product->getImageUrl('small'); ?>">
                </td>
                <td>
                    <a style="color:#333333; font-size:13px; font-family:Georgia, 'Times New Roman', Times, serif;" href="<?php echo $product->url; ?>"><?php echo $product->name; ?></a>
                </td>
                <td><span style="font-size:17px; color:#333333;"><?php echo Yii::app()->priceFormatter->format($product->price); ?></span></td>
                <td>
                    <?php echo $form->textField($product, "[$i]quantity", array('class'=>'cart-quantity',)); ?>
                    <b class="clearb"></b>
                    <a style="font-size:11px; font-family:Arial, Helvetica, sans-serif; color:#666; text-decoration:none;" href="#" onclick="$('#products-form').submit();return false;">ОБНОВИТЬ</a>
                </td>
                <td style="line-height: 180%;">
                    <strong style="font-size:17px;">
                        <?php echo Yii::app()->priceFormatter->format($product->sumPrice); ?>
                    </strong>
                    <b class="clearb"></b>
                    <a style="font-size:14px; color:#1a1a1a;" href="<?php echo $this->createUrl('remove', array('id'=>$product->id, 'return_url'=>Yii::app()->request->hostInfo.Yii::app()->request->url)); ?>">Удалить</a>
                </td>
            </tr>
<?php endforeach; ?>
        </table>
        <?php $this->endWidget(); ?>
    </div>

    <div class="order_controls">
        <div class="kupon">
            <?php if(false): ?>
            <?php $form=$this->beginWidget('CActiveForm', array(
                'action'=>$this->createUrl('order/coupon')
            )); ?>
            <div class="kupon_head">
            Код купона на скидку
                <!-- ПРИМЕР Значка Инфо в корзине, как на розетке -->
                <a href="#cupon_info" class="info_icon"></a>
            </div>
            <input style="border:1px solid #e5e5e5; background:#fff; width:150px;" type="text" name="coupon" value="<?php echo @Yii::app()->user->getState('coupon'); ?>" />
            <input style="background:#e9e9e9; border:1px solid #999999; height:28px; margin:10px 0 0 15px; cursor:pointer; padding:0 10px; font-size:12px; font-weight:bold; color:#4d4d4d;" type="submit" value="ПРИМЕНИТЬ" />
            <?php $this->endWidget(); ?>
            <?php endif; ?>
        </div>
        <div class="korzina_total">
            <div>Количество <?php echo Yii::app()->cart->getItemsCount(); ?> шт.</div>
            <div style="margin:10px 0 0; font-size: 24px; color:#333333;">ИТОГО: <?php echo Yii::app()->priceFormatter->format(Yii::app()->cart->cost-(Yii::app()->cart->cost*$order->discount/100));//Yii::app()->priceFormatter->format(Yii::app()->cart->cost); ?></div>
        </div>

<?php /*if(!isset($_GET['show_user_menu'])):*/ ?>
        <div class="korzina_order">
            <a href="<?php echo $this->createUrl('order/index'); ?>"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/form_order_button.png" /></a>
        </div>
<?php /*endif;*/ ?>

    </div>
</div>

    <div id="cupon_info" style="display: none;">
        <?php $article = Article::model()->findByPk(17);?>
        <h3><?php echo $article->title;?></h3>
        <div><?php echo $article->content;?></div>
    </div>

<script type="text/javascript">
    $('.info_icon').fancybox();
    $('.cart-quantity').change(function(){
        $('#products-form').submit();
    })
</script>
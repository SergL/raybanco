<?php if(Yii::app()->cart->isEmpty): ?>
    <div class="cart">
        <div class="cart_l">
        </div>
        <div class="cart_r">
            <div class="cart_head">Корзина</div>
            <div class="cart_text">0 товаров</div>
        </div>
    </div>
<?php else: ?>
    <a href="<?php echo Yii::app()->createUrl('order/book') ?>"><div class="cart">
        <div class="cart_l">
        </div>
        <div class="cart_r">
            <div class="cart_head">Корзина</div>
            <div class="cart_text"><?php echo Yii::t('app', '{n} товар|{n} товара|{n} товаров|{n} товар', Yii::app()->cart->itemsCount); ?></div>
        </div>
    </div></a>
<?php endif; ?>
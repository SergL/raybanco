<div class="product <?php if($product->status==Product::STATUS_ABSENT) echo 'product-absent-view'; ?>">
    <div class="product_pic">
        <a href="<?php echo $product->url; ?>"><img src="<?php echo $product->getImageUrl('small'); ?>" alt="<?php echo $product->sname; ?> <?php echo $product->fullname; ?>" /></a>
    </div>
    <div class="product_name">
        <table>
            <tr>
                <td><a href="<?php echo $product->url; ?>"><?php echo $product->fullname; ?><br><?php echo $product->sname; ?></a></td>
            </tr>
        </table>
    </div>
    <div class="product_price">
        <?php echo Yii::app()->priceFormatter->templateFormat('<span class="price-big">{int}</span> <sup class="grn">{currency}</sup>', $product->price); ?>
        <span class="product_price_old">
            <?php if($product->other_price): ?>
            <?php echo Yii::app()->priceFormatter->templateFormat(' / <span class="price-big">{int} </span><sup class="grn">{currency}</sup>', $product->other_price); ?>
            <?php endif; ?>
        </span>
    </div>
    <div class="product_status_icon">
        <?php if($product->novelty): ?>
            <img height="30px" src="<?php echo Yii::app()->theme->baseUrl; ?>/images/ray1.png"  alt="Новинки"/>
        <?php endif; ?>
        <?php if($product->hit): ?>
            <img height="30px" src="<?php echo Yii::app()->theme->baseUrl; ?>/images/ray2.png" alt="Спецпредложение"/>
        <?php endif; ?>
        <?php if($product->shopwindow): ?>
            <img height="30px" src="<?php echo Yii::app()->theme->baseUrl; ?>/images/ray3.png" alt="Хит"/>
        <?php endif; ?>
    </div>
</div>
	<b>
        Заказ №<?php echo $data->id; ?>
        (<?php echo Yii::app()->dateFormatter->format('dd MMMM y, HH:mm:ss', $data->create_time); ?>)
        <span style="float: right;">
            <?php echo Lookup::item('OrderStatus', $data->status); ?>
        </span>
    </b>
<table>

<tr>

<td>
    <?php echo $data->getAttributeLabel('name'); ?>: <?php echo $data->name; ?><br>
    <?php echo $data->getAttributeLabel('phone'); ?>: <?php echo $data->phone; ?><br>

</td>
<td>
        <?php foreach($data->products as $product): ?>

           #<?php echo $product->id ; ?> <?php echo CHtml::link($product->name, array('product/update', 'id'=>$product->id)) ; ?>
            <?php echo $product->quantity ; ?> × <?php echo Yii::app()->priceFormatter->format($product->orderPrice, true); ?><br>

        <?php endforeach; ?>
    Сумма: <?php echo Yii::app()->priceFormatter->format($data->cost, true); ?><br>
</td>
</tr>
</table>

<b>Город <?php echo $data->city->name; ?></b>

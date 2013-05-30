<table class="order-cart">
    <thead>
        <tr>
            <th>Наименование</th>
            <th>Сумма</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($products as $product): ?>
        <tr>
            <td><?php echo CHtml::link($product->name.' '.$product->additional_params, array('product/update', 'id'=>$product->id)) ; ?></td>
            <td><?php echo $product->quantity ; ?> × <?php echo Yii::app()->priceFormatter->format($product->orderPrice, true); ?></td>
        </tr>
        <?php endforeach; ?>
        <?php if($model->delivery): ?>
        <tr>
            <td>
                <?php echo CHtml::link('Доставка: '.$model->delivery->name, array('delivery/update', 'id'=>$model->delivery->id)) ; ?>
            </td>
            <td><?php echo Yii::app()->priceFormatter->format($model->delivery_price, true); ?></td>
        </tr>
        <?php endif; ?>

        <tr>
            <td>Скидка</td>
            <td><?php echo $model->discount?$model->discount:'0'; ?>%</td>
        </tr>
        <tr>
            <td><h3>Итого</h3></td>
            <td><h3><?php echo Yii::app()->priceFormatter->format($model->cost+$model->delivery_price, true); ?></h3></td>
        </tr>
    </tbody>
</table>
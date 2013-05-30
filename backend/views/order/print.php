<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <script type="text/javascript">
        window.print();
        $(document).ready(function(){

        })
    </script>
</head>
<body>

<h1>Заказ №<?php echo $model->id; ?></h1>


    <table>
        <tbody>
        <tr>
            <td>
                Доставка
            </td>
            <td>
                <?php echo $model->delivery->name;?>
            </td>
        </tr>
        <tr>
            <td>
                Стоимость доставки
            </td>
            <td>
                <?php echo $model->delivery_price;?>
            </td>
        </tr>
        <tr>
            <td>
                Скидка (%)
            </td>
            <td>
                <?php echo $model->discount;?>
            </td>
        </tr>
        <tr>
            <td>
                Оплата
            </td>
            <td>
                <?php echo Payment::model()->findByPk($model->payment_id)->name;?>
            </td>
        </tr>
        <tr>
            <td>
                Состояние оплаты
            </td>
            <td>
                <?php echo Lookup::item('OrderPaymentStatus', $model->payment_status);?>
            </td>
        </tr>
        <tr>
            <td>
                ФИО
            </td>
            <td>
                <?php echo $model->name;?>
            </td>
        </tr>
        <tr>
            <td>
                Телефон
            </td>
            <td>
                <?php echo $model->phone;?>
            </td>
        </tr>
        <tr>
            <td>
                Email
            </td>
            <td>
                <?php echo $model->email;?>
            </td>
        </tr>
        <tr>
            <td>
                Адрес / доставка
            </td>
            <td>
                <?php echo $model->address;?>
            </td>
        </tr><tr>
            <td>
                Комментарий
            </td>
            <td>
                <?php echo $model->comment;?>
            </td>
        </tr>

        </tbody>
    </table>

<table class="order-cart">
    <thead>
    <tr>
        <th>Наименование</th>
        <th>Сумма</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($model->products as $product): ?>
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
        <td><h3><?php echo Yii::app()->priceFormatter->format($model->cost, true); ?></h3></td>
    </tr>
    </tbody>
</table>

</body></html>
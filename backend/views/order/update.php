<?php
$this->breadcrumbs=array(
	'Заказы'=>array('index'),
    Lookup::item('OrderStatus', $model->status)=>array('index', 'status'=>$model->status),
	'Заказ №'.$model->id,
);

$this->menu=array(
	array('label'=>'Заказы', 'url'=>array('index')),
    array('label'=>'Удалить', 'url'=>'#', 'linkOptions'=>array(
        'submit'=>array('status', 'id'=>$model->id),
        'params'=>array('status'=>Order::STATUS_DELETE, 'returnUrl'=>Yii::app()->request->requestUri),
        'confirm'=>'Вы уверены, что хотите удалить заказ?'
    )),
);
?>

<h1>Заказ №<?php echo $model->id; ?> <?php echo CHtml::link('Печать', array('order/print', 'id'=>$model->id, ), array('target'=>'_blank'));?></h1>


<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
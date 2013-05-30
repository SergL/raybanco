<div class="form">

<?php
    $this->layout='column1';
    $form=$this->beginWidget('CActiveForm', array(
	'id'=>'config-form',
	'enableAjaxValidation'=>false,
)); ?>

    <h2>Купоны на скидку</h2>

    <div class="row">
   		<?php echo $form->labelEx($model,'coupons_val'); ?>
        <?php echo $form->textField($model,'coupons_val'); ?>
   		<?php echo $form->error($model,'coupons_val'); ?>
   	</div>

    <div class="row">
   		<?php echo $form->labelEx($model,'coupons'); ?>
        <?php echo $form->textArea($model,'coupons', array('cols'=>70, 'rows'=>10)); ?>
   		<?php echo $form->error($model,'coupons'); ?>
   	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton('Сохранить', array('class'=>'save_button')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
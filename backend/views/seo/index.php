<?php
$this->layout='column1';
$this->breadcrumbs=array(
	'SEO информация'
);
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'seo-form',
)); ?>

<?php foreach($models as $i=>$model): ?>

<fieldset style="float: left;margin: 5px;">
   <legend><b><?php echo Lookup::item('SEORoute', $model->route); ?></b></legend>

	<div class="row">
		<?php echo $form->labelEx($model,"[$i]metaTitle"); ?>
		<?php echo $form->textField($model,"[$i]metaTitle",array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,"[$i]metaTitle"); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,"[$i]metaKeywords"); ?>
		<?php echo $form->textField($model,"[$i]metaKeywords",array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,"[$i]metaKeywords"); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,"[$i]metaDescription"); ?>
		<?php echo $form->textField($model,"[$i]metaDescription",array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,"[$i]metaDescription"); ?>
	</div>



</fieldset>

<?php endforeach; ?>
    
    <b class="clearb"></b>

    <div class="row buttons">
   		<?php echo ''; ?>
   	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
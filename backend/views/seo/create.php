<?php
$this->breadcrumbs=array(
	'SEO информация'=>array('index'),
	'Добавление',
);

$this->menu=array(
	array('label'=>'Каталог', 'url'=>array('index')),
);
Yii::app()->clientScript->registerScript('uniqueUrl', "
    $('#SEO_route').change(function(){
        $('#SEO_params').focus();
    });
");
?>

<h1>Добавление SEO информации</h1>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'seo-form',
	'enableAjaxValidation'=>true,
    'htmlOptions'=>array(
        'enctype'=>'multipart/form-data',
    ),
)); ?>

<p class="note">Поля отмеченные <span class="required">*</span> обязательны для заполнения.</p>

<?php echo $form->errorSummary($model); ?>

<div class="row">
	<?php echo $form->labelEx($model,'route'); ?>
	<?php echo $form->dropDownList($model,'route',Lookup::items('SEORoute'), array('empty'=>'')); ?>
	<?php echo $form->error($model,'route'); ?>
</div>

<div class="row">
    <?php echo $form->labelEx($model,'params'); ?>
	<?php echo $form->textField($model,'params',array('size'=>60,'maxlength'=>500)); ?>
	<?php echo $form->error($model,'params'); ?>
</div>

<?php echo $this->renderPartial('_form', array(
    'model'=>$model,
    'form'=>$form
)); ?>

<?php $this->endWidget(); ?>

</div>
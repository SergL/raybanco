<?php
$this->breadcrumbs=array(
	'SEO информация'=>array('index'),
	'Страница "'.Lookup::item('SEORoute', $model->route).'"',
);

$this->menu=array(
	array('label'=>'Каталог', 'url'=>array('index')),
	array('label'=>'Добавить', 'url'=>array('create')),
	array('label'=>'Удалить', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Вы уверены, что хотите удалить SEO информацию?')),
);
?>

<h1>SEO информация страницы "<?php echo Lookup::item('SEORoute', $model->route); ?>"</h1>

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

<?php echo $this->renderPartial('_form', array(
    'model'=>$model,
    'form'=>$form
)); ?>

<?php $this->endWidget(); ?>

</div>
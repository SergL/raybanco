<div class="wide form">

<p>
Вы можете дополнительно ввести оператор сравнения (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
или <b>=</b>) в начале каждого из Ваших поисковых значений, чтобы определить, как сравнение должно быть сделано.
</p>

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'metaTitle'); ?>
		<?php echo $form->textField($model,'metaTitle',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'metaKeywords'); ?>
		<?php echo $form->textField($model,'metaKeywords',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'metaDescription'); ?>
		<?php echo $form->textField($model,'metaDescription',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'route'); ?>
		<?php echo $form->dropDownList($model,'route', Lookup::items('SEORoute'), array('empty'=>'')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'params'); ?>
		<?php echo $form->textField($model,'params',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Поиск', array('class'=>'search_button')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
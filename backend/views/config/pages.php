<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'config-form',
	'enableAjaxValidation'=>true,
)); ?>

    <h2>Страницы</h2>

    <fieldset>
        <legend>Главная страница</legend>

        <div class="row">
            <?php echo $form->labelEx($model,'index_video'); ?>
            <?php echo $form->textField($model,'index_video',array('size'=>60,'maxlength'=>255)); ?>
            <?php echo $form->error($model,'index_video'); ?>
        </div>

        <div class="row">
       		<?php echo $form->labelEx($model,'main_text'); ?>
               <?php $this->widget('ElRTE', array(
                   'model'=>$model,
                   'attribute'=>'main_text',
                   'options' => array(
                       'height' => '100',
                   ),
               )); ?>
       		<?php echo $form->error($model,'main_text'); ?>
       	</div>

    </fieldset>

    <div class="row">
        <?php echo $form->labelEx($model,'user_register_text'); ?>
        <?php $this->widget('ElRTE', array(
        'model'=>$model,
        'attribute'=>'user_register_text',
        'options' => array(
            'height' => '100',
        ),
    )); ?>
        <?php echo $form->error($model,'user_register_text'); ?>
    </div>


    <div class="row">
        <?php echo $form->labelEx($model,'afterbuy_text'); ?>
        <?php $this->widget('ElRTE', array(
        'model'=>$model,
        'attribute'=>'afterbuy_text',
        'options' => array(
            'height' => '100',
        ),
    )); ?>
        <?php echo $form->error($model,'afterbuy_text'); ?>
    </div>

    <fieldset>
        <legend>Страница контакты</legend>

        <div class="row">
            <?php echo $form->labelEx($model,'contact_text'); ?>
            <?php $this->widget('ElRTE', array(
                'model'=>$model,
                'attribute'=>'contact_text',
                'options' => array(
                    'height' => '100',
                ),
            )); ?>
            <?php echo $form->error($model,'contact_text'); ?>
        </div>

        <div class="row" style="width: 680px;">
            <?php echo $form->labelEx($model,'contact_map'); ?>
            <?php $this->widget('CodeMirror', array(
                'model'=>$model,
                'attribute'=>'contact_map',
            )); ?>
            <?php echo $form->error($model,'contact_map'); ?>
        </div>

        <div class="row">
            <?php echo $form->checkBox($model,'contact_use_captcha', array('value'=>1)); ?>
            <?php echo $form->label($model,'contact_use_captcha'); ?>
            <?php echo $form->error($model,'contact_use_captcha'); ?>
        </div>

    </fieldset>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Сохранить', array('class'=>'save_button')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

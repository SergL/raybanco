<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>true,
)); ?>

	<!--<p class="note">Поля отмеченные <span class="required">*</span> обязательны для заполнения.</p>-->

	<?php //echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('size'=>60,'maxlength'=>255, 'disabled'=>!$model->isNewRecord)); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

<?php if(!$model->isNewRecord): ?>

<?php
    Yii::app()->clientScript->registerScript('changePassword', "
        $('#changePassword').change(function(){
            if($(this).is(':checked'))
                $('div.change-password').show();
            else
                $('div.change-password').hide();
        }).change();
    ");
?>

    <div class="row">

        <label for="changePassword"><?php echo CHtml::checkBox('changePassword', $model->scenario=='changePassword', array('style'=>'display: none;')); ?> <span style="color: #08C;cursor:pointer;">Изменить пароль</span></label>
    </div>

<?php endif; ?>

    <div class="row change-password">
        <?php echo $form->labelEx($model,'password'); ?>
        <?php echo $form->passwordField($model,'password', array('value'=>'', 'size'=>45,'maxlength'=>128)); ?>
        <?php echo $form->error($model,'password'); ?>
    </div>

    <div class="row change-password">
        <?php echo $form->labelEx($model,'rPassword'); ?>
        <?php echo $form->passwordField($model,'rPassword', array('value'=>'', 'size'=>45,'maxlength'=>128)); ?>
        <?php echo $form->error($model,'rPassword'); ?>
    </div>

    <div class="row user-role">
   		<?php echo $form->labelEx($model,'name'); ?>
        <?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
   		<?php echo $form->error($model,'name'); ?>
   	</div>

    <?php if(false and !$model->isNewRecord): ?>
    <div class="row">
   		<?php echo $form->labelEx($model, 'payment_id'); ?>
   		<?php echo $form->dropDownList($model, 'payment_id', CHtml::listData(Payment::model()->findAll(), 'id', 'name'), array('empty'=>'')); ?>
   		<?php echo $form->error($model, 'payment_id'); ?>
   	</div>

    <div class="row">
   		<?php echo $form->labelEx($model, 'delivery_id'); ?>
   		<?php echo $form->dropDownList($model, 'delivery_id', CHtml::listData(Delivery::model()->findAll(), 'id', 'name'), array('empty'=>'')); ?>
   		<?php echo $form->error($model, 'delivery_id'); ?>
   	</div>
    <?php endif; ?>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'phone'); ?>
		<?php echo $form->textField($model,'phone',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'phone'); ?>
	</div>

	<!--<div class="row user-role">
		<?php /*echo $form->labelEx($model,'address'); */?>
		<?php /*echo $form->textArea($model,'address',array('rows'=>2, 'cols'=>50)); */?>
		<?php /*echo $form->error($model,'address'); */?>
	</div>-->

    <?php if($model->isNewRecord): ?>
    <div class="row">
            <label><?php echo CHtml::checkBox('use_personal_data', false, array('id'=>'use_personal_data'));?>

                Регистрируясь, вы соглашаетесь с <a style="border-bottom: 1px dashed #08C; text-decoration: none;" class="fancybox" href="#inline">пользовательским соглашением</a>
        </label>

            <div id="inline" style="width: 500px; display: none;">
                <?php $text = Article::model()->findByPk(14);?>
                <h2><?php echo $text->title;?></h2>

                <p>
                    <?php echo $text->content;?>
                </p>
            </div>

    </div>
    <?php endif;?>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Зарегистрироваться' : 'Сохранить', array('class'=>'save_button save_disabled', 'disabled'=>true)); ?>
	</div>

<?php if($model->isNewRecord): ?>

    <script type="text/javascript">
        $(document).ready(function(){
            $('#use_personal_data').change(function(){
                if($('#use_personal_data:checked').length)
                    $('div.buttons input.save_button').removeAttr('disabled').removeClass('save_disabled');
                else
                    $('div.buttons input.save_button').attr('disabled', 'ture').addClass('save_disabled');
            })
        })
    </script>

<?php else:?>

    <script type="text/javascript">
        $(document).ready(function(){
            $('div.buttons input.save_button').removeAttr('disabled').removeClass('save_disabled');
        })
    </script>
<?php endif;?>

<?php $this->endWidget(); ?>

</div><!-- form -->

<script type="text/javascript">
    $(document).ready(function() {
        $(".fancybox").fancybox({
            maxWidth	: 800,
            maxHeight	: 600,
            fitToView	: false,
            width		: '70%',
            height		: '70%',
            autoSize	: false,
            closeClick	: false,
            openEffect	: 'none',
            closeEffect	: 'none'
        });
    });
</script>
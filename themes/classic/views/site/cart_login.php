<div class="korzina">

    <div class="korzina_head">
        <span>Авторизация</span>
    </div>

    <div class="korzina_menu">
        <ul>
            <li><a href="<?php echo Yii::app()->createUrl('order/index'); ?>">Оформить заказ</a></li>
            <li class="active"><a href="#">Я зарегистрирован</a></li>
            <!--<li><a href="<?php /*echo Yii::app()->createUrl('user/lostpass'); */?>">Восстановить пароль</a></li>-->
        </ul>
    </div>

    <b class="clearb"></b>
    <div class="menu-content">


<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableAjaxValidation'=>true,
)); ?>


	<div class="row">
		<?php echo $form->labelEx($login,'username'); ?>
		<?php echo $form->textField($login,'username'); ?>
		<?php echo $form->error($login,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($login,'password'); ?>
		<?php echo $form->passwordField($login,'password'); ?>
		<?php echo $form->error($login,'password'); ?>
	</div>

	<div class="row rememberMe">
		<?php echo $form->checkBox($login,'rememberMe'); ?>
		<nobr><?php echo $form->label($login,'rememberMe'); ?></nobr>
		<?php echo $form->error($login,'rememberMe'); ?>
	</div>

    <div class="row">
        <a href="<?php echo Yii::app()->createUrl('user/lostpass');?>">Восстановить пароль</a>
    </div>

	<div class="row buttons enter_btn">
		<?php echo CHtml::submitButton('Войти'); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->

     </div>
    
</div>
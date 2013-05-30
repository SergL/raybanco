<div class="korzina">

    <div class="korzina_head">
        <span>Восстановление пароля</span>
    </div>

    <!--<div class="korzina_menu">
        <ul>
            <li><a href="<?php /*echo Yii::app()->createUrl('order/index'); */?>">Оформить заказ</a></li>
            <li><a href="<?php /*echo Yii::app()->createUrl('site/login'); */?>">Я зарегистрирован</a></li>
            <li class="active"><a href="#">Восстановить пароль</a></li>
        </ul>
    </div>
    <b class="clearb"></b>-->
    <div class="menu-content">


    <?php if(Yii::app()->user->hasFlash('lostpass_error')): ?>

    <div class="flash-success">
        <?php echo Yii::app()->user->getFlash('lostpass_error'); ?>
    </div>

    <?php endif; ?>

    <?php if(Yii::app()->user->hasFlash('lostpass')): ?>

    <div class="flash-success">
        <?php echo Yii::app()->user->getFlash('lostpass'); ?>
    </div>

    <?php else: ?>


    <div class="form">
        <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'login-form',
        'enableAjaxValidation'=>true,
    )); ?>


        <div class="row">
            <label for="email" class="required">Електронная почта <span class="required">*</span></label>
            <input name="email" id="email" type="text" style="width: 300px;">
        </div>


        <div class="row buttons">
            <?php echo CHtml::submitButton('Восстановить пароль', array('style'=>'width:160px;')); ?>
        </div>

        <?php $this->endWidget(); ?>
    </div><!-- form -->

    <?php endif; ?>

    </div>

</div>
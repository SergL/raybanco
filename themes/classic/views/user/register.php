<?php /*
  *
  * $article - статья
  *
  * */ ?>
<style type="text/css">
    .dynamic_content form .errorMessage{
        float:  none;
    }
    .dynamic_content form input {
        border: 1px solid #E5E5E5;
        width: 328px;
        font-size: 13px;
        height: 23px;
        margin: 10px 0 0;
        padding: 0 5px;
    }
    .dynamic_content form #use_personal_data{
        width: 20px;
        height: auto;
    }
    .dynamic_content form .buttons input {
        width: 155px;
        cursor: pointer;
        font-family: "Helvetica Neue", helvetica, arial, sans-serif;
        font-size: 12px;
        font-weight: 700;
        background: url(https://securecdn.disqus.com/1333412399/img/ui/buttons/grey-button-bg.jpg) center center repeat-x;
        border: 1px solid #8B8B8B;
        -moz-border-radius: 3px;
        border-radius: 3px;
        padding: 8px 16px;
        text-shadow: 0 1px 0 white;
        margin: 0;
        -webkit-box-shadow: inset 0 1px 0 white, 0 1px 2px rgba(0, 0, 0, .2);
        -moz-box-shadow: inset 0 1px 0 #fff, 0 1px 2px rgba(0,0,0, .2);
        box-shadow: inset 0 1px 0 white, 0 1px 2px rgba(0, 0, 0, .2);
        color: #444;
        height: 30px;
</style>
<?php $this->layout='column1'; ?>
<div class="korzina_head">
    <span>Регистрация</span>
</div>
<div class="dynamic_content">
    <?php if(Yii::app()->user->hasFlash('register')): ?>

    <div><?php echo Yii::app()->user->getFlash('register'); ?></div>

    <?php else: ?>

    <?php $this->renderPartial('_form', array('model'=>$user)); ?>

    <?php endif; ?>
</div>
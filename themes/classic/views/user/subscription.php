<?php /*
  *
  * $article - статья
  *
  * */ ?>
<?php $this->layout='column1'; ?>
<div class="blog">
    <div class="blog_l">
        <?php $this->renderPartial('_left'); ?>
    </div>
    <div class="blog_r">
        <div class="article_short">


            <div class="dynamic_head article_short_head">
                <span>Подписка</span>
            </div>

            <?php if(Yii::app()->user->hasFlash('success')): ?>
            <b class="clearb"></b>
            <h4><?php echo Yii::app()->user->getFlash('success'); ?></h4>

            <?php endif; ?>

            <b class="clearb"></b>

            <div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'user-form',
)); ?>



    <div class="row">
        <?php echo $form->checkBox($model,'subscription', array('style'=>'float:left;margin-right:4px;')); ?>
        <?php echo $form->label($model,'subscription'); ?>
        <?php echo $form->error($model,'subscription'); ?>
    </div>

                <b class="clearb"></b>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Подписаться', array('class'=>'save_button save_disabled', 'disabled'=>'disabled', 'style'=>'width:150px;')); ?>
    </div>

<?php $this->endWidget(); ?>

           </div><!-- form -->


        </div>

    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('#User_subscription').change(function(){
            if($('#User_subscription:checked').length)
                $('div.buttons input.save_button').removeAttr('disabled').removeClass('save_disabled');
            else
                $('div.buttons input.save_button').attr('disabled', 'ture').addClass('save_disabled');
        })
    })
</script>
<?php $this->layout='column1'; ?>
<div class="blog">
    <div class="blog_l">
        <?php $this->renderPartial('_left'); ?>
    </div>
    <div class="blog_r">
        <div class="article_short">
            <div class="dynamic_head article_short_head"><span>Редактирование информации</span></div>

            <b class="clearb"></b>

            <?php if(Yii::app()->user->hasFlash('success')): ?>

            <h3><?php echo Yii::app()->user->getFlash('success'); ?></h3>

            <?php endif; ?>

            <?php $this->renderPartial('_form', array('model'=>$model)); ?>

        </div>

    </div>
</div>

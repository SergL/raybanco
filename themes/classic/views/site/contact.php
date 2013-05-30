

<?php $this->layout='column1'; ?>
<div class="dynamic_content">
<?php if(Yii::app()->user->hasFlash('contact')): ?>

<div class="flash-success">
	<?php echo Yii::app()->user->getFlash('contact'); ?>
</div>

<?php else: ?>

<p><?php echo Yii::app()->config['contact_text']; ?></p>

<?php echo Yii::app()->config['contact_map']; ?>

<!-- form -->

<?php endif; ?>
</div>
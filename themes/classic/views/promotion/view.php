<b class="clearb"></b>
<br />
<br /><div class="dynamic_head"><?php echo $promotion->title; ?></div>
<br>
<div class="dynamic_content">
    <?php echo $promotion->content; ?>
</div>

<h2>Товары что участвуют в акции:</h2>

<?php foreach($promotion->products as $product): ?>
    <?php $this->renderPartial('//product/_view', array('product'=>$product)); ?>
<?php endforeach; ?>
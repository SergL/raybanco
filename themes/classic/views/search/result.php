<div class="korzina_head">
    <span>Результаты поиска</span>
</div>

<div class="product-head" style="margin-top: 0px">
    <?php $this->widget('zii.widgets.CBreadcrumbs', array(
    'links'=>$this->breadcrumbs,
)); ?>
</div>

<br>
<div class="dynamic_content">

<?php foreach($dataProvider->data as $product):?>
    <?php $this->renderPartial('/product/_view', array('product'=>$product)); ?>
<?php endforeach; ?>

<?php if($dataProvider->itemCount==0): ?>
    Поиск не дал результатов.
<?php endif; ?>
<div class="pagination">
    <?php $this->widget('CLinkPager', array(
        'pages'=>$dataProvider->pagination,
    )); ?>
</div>

</div>
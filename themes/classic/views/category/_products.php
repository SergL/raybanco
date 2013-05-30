<?php /*
  *
  * $category - категория
  * $dataProvider - товары текущей категории
  *
  * */ ?>


    <?php foreach($dataProvider->data as $product): ?>
        <?php $this->renderPartial('/product/_view', array('product'=>$product)); ?>
    <?php endforeach; ?>

<div class="pagination">
<?php $this->widget('CLinkPager', array(
     'pages'=>$dataProvider->pagination,
    'prevPageLabel'=>'НАЗАД',
    'nextPageLabel'=>'ВПЕРЕД',
)); ?>
</div>
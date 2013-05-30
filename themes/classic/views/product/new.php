<?php /*
  *
  * $dataProvider - товары текущей категории
  *
  * */ ?>

<?php $this->layout='column1'; ?>
<div class="breadcrumbs">
    <?php $this->widget('zii.widgets.CBreadcrumbs', array(
        'links'=>$this->breadcrumbs,
    )); ?>
</div>
    <?php
        $scrap = ScrapItem::model()->findByAttributes(array('scrap_id'=>2));
        if($scrap)
            echo $scrap->renderTemplate();
    ?>
<div class="content">
    <div class="content_l">
        <?php $this->renderPartial('_filters');  ?>
    </div>
    <div class="content_right">

        <div class="content_right_head">
            <div class="sort">
                <?php $sort=$dataProvider->sort; ?>
                <div class="sort_head">

                    <?php switch (@$_GET['sort']) {
                        case 'price':
                            echo 'Сначала дешевле';
                            break;
                        case 'price.desc':
                            echo 'Сначала дороже';
                            break;
                        case 'novelty.desc':
                            echo 'Новинки';
                            break;
                        case 'in_promotion.desc':
                            echo 'Акции и скидки';
                            break;
                        case 'hit.desc':
                            echo 'Хит продаж';
                            break;
                                              default:
                            echo 'Отсортировать по';
                    } ?>

                    <div class="sort_drop">
                        <?php if(isset($_GET['sort'])):?>
                        <a href="<?php echo $this->createUrl($this->route); ?>">Отсортировать по</a>
                        <?php endif; ?>
                        <?php if(@$_GET['sort']!='price'):?>
                        <a href="<?php echo $sort->createUrl($this, array('price'=>false)); ?>">Сначала дешевле</a><br>
                        <?php endif; ?>
                        <?php if(@$_GET['sort']!='price.desc'):?>
                        <a href="<?php echo $sort->createUrl($this, array('price'=>true)); ?>">Сначала дороже</a><br>
                        <?php endif; ?>
                        <?php if(@$_GET['sort']!='novelty.desc'):?>
                        <a href="<?php echo $sort->createUrl($this, array('novelty'=>true)); ?>">Новинки</a><br>
                        <?php endif; ?>
                        <?php if(@$_GET['sort']!='in_promotion.desc'):?>
                        <a href="<?php echo $sort->createUrl($this, array('in_promotion'=>true)); ?>">Акции и скидки</a><br>
                        <?php endif; ?>
                        <?php if(@$_GET['sort']!='hit.desc'):?>
                        <a href="<?php echo $sort->createUrl($this, array('hit'=>true)); ?>">Хит продаж</a>
                        <?php endif; ?>
                        <?php if(@$_GET['sort']!='create_time.desc'):?>
                            <a href="<?php echo $sort->createUrl($this, array('create_time'=>true)); ?>">Последние</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="view">
                <span>ПРОСМОТРЫ</span>

                <a <?php if(@$_GET['limit']==40): ?>class="view_active"<?php endif; ?> href="<?php echo $this->createUrl('view', CMap::mergeArray($_GET, array('limit'=>40, 'Product_page'=>1))); ?>">40</a>
                <a <?php if(@$_GET['limit']==60): ?>class="view_active"<?php endif; ?> href="<?php echo $this->createUrl('view', CMap::mergeArray($_GET, array('limit'=>60, 'Product_page'=>1))); ?>">60</a>
                <a <?php if(@$_GET['limit']==80): ?>class="view_active"<?php endif; ?> href="<?php echo $this->createUrl($this->route, CMap::mergeArray($_GET, array('limit'=>80, 'Product_page'=>1))); ?>">80</a>
            </div>
            <div class="pagination">
            <?php $this->widget('CLinkPager', array(
                 'pages'=>$dataProvider->pagination,
                'prevPageLabel'=>'НАЗАД',
                'nextPageLabel'=>'ВПЕРЕД',
            )); ?>
            </div>
        </div>
        <div class="content_r_head"><em><b>НОВИНКИ</b></em></div>


<?php if($dataProvider->itemCount==0):  ?>
    <h3>Товаров не найдено</h3>
<?php endif; ?>

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



    </div>
</div>
<div class="site_text">
    <?php echo Yii::app()->config['main_text']; ?></div>
<?php /*
  *
  * $category - категория
  * $dataProvider - товары текущей категории
  *
  * */ ?>

<?php $this->layout='column1'; ?>
<div class="breadcrumbs">
    <?php $this->widget('zii.widgets.CBreadcrumbs', array(
    'links'=>$this->breadcrumbs,
    )); ?>
</div>
<div class="category_description">
    <div class="category_pic">
        <img src="<?php echo $brand->getImageUrl('large'); ?>" />
    </div>
    <div class="category_text">
        <?php echo $brand->description; ?>
    </div>
</div>
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
                        <a href="<?php echo $this->createUrl('view', array('id'=>$brand->id)); ?>">Отсортировать по</a>
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
                    </div>
                </div>
            </div>
            <div class="view">
                <span>ПРОСМОТРЫ</span>
                <a <?php if(@$_GET['limit']==20): ?>class="view_active"<?php endif; ?> href="<?php echo $this->createUrl('view', CMap::mergeArray($_GET, array('limit'=>20, 'Product_page'=>1))); ?>">20</a>
                <a <?php if(@$_GET['limit']==40): ?>class="view_active"<?php endif; ?> href="<?php echo $this->createUrl('view', CMap::mergeArray($_GET, array('limit'=>40, 'Product_page'=>1))); ?>">40</a>
                <a <?php if(@$_GET['limit']==60): ?>class="view_active"<?php endif; ?> href="<?php echo $this->createUrl('view', CMap::mergeArray($_GET, array('limit'=>60, 'Product_page'=>1))); ?>">60</a>
            </div>
            <div class="pagination">
            <?php $this->widget('CLinkPager', array(
                 'pages'=>$dataProvider->pagination,
                'prevPageLabel'=>'НАЗАД',
                'nextPageLabel'=>'ВПЕРЕД',
            )); ?>
            </div>
        </div>

        <?php

                $this->renderPartial('_products', array(
                    'dataProvider'=>$dataProvider,
                    'brand'=>$brand,
                ));

        ?>

    </div>
</div>
<div class="site_text">
    <?php echo Yii::app()->config['main_text']; ?>
</div>
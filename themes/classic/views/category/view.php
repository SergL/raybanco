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
    <?php
    if(isset($_GET['Product']['brand_id'])):
    $brand=Brand::model()->findByPk($_GET['Product']['brand_id']);
    ?>
        <img src="<?php echo $brand->image?$brand->getImageUrl('large'):$category->getImageUrl('large'); ?>" />
        <?php else: ?>

        <img src="<?php echo $category->getImageUrl('large'); ?>" />
        <?php endif; ?>
    </div>
    <div class="category_text">
        <?php echo $brand->description?$brand->description:$category->description; ?>
    </div>
</div>
<div class="content">
    <div class="content_l">
        <?php $this->renderPartial('_filters', array(
        'category'=>$category,
    ));  ?>
    </div>
    <div class="content_right">
        <div class="content_right_head">
            <div class="sort">
                <?php $sort=$dataProvider->sort; ?>
                <div class="sort_head">

                    <?php switch (@$_GET['sort']) {
                        case 'price-name':
                            echo 'Сначала дешевые';
                            break;
                        case 'price.desc-name':
                            echo 'Сначала дорогие';
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
<?php $get=$_GET; if(isset($get['sort'])) unset($get['sort']); if(isset($_GET['sort'])):?>
                        <a href="<?php echo $this->createUrl('view', $get); ?>">Отсортировать по</a>
<?php endif; ?>
<?php if(@$_GET['sort']!='price-name'):?>
                        <a href="<?php echo $sort->createUrl($this, array('price'=>false, 'name'=>false)); ?>">Сначала дешевые</a><br>
<?php endif; ?>
<?php if(@$_GET['sort']!='price.desc-name'):?>
                        <a href="<?php echo $sort->createUrl($this, array('price'=>true, 'name'=>false)); ?>">Сначала дорогие</a><br>
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
<?php if($category->id==5): ?>
<div class="content_r_head"><em><b>АКСЕССУАРЫ</b></em></div>
<?php endif; ?>

<?php
if(isset($_GET['Product']['brand_id'])):
    $brand=Brand::model()->findByPk($_GET['Product']['brand_id']);
    $children=$brand->children;
?>

<div class="brands-list">
<div class="brandosa">
<a <?php if(empty($_GET['bbid'])) echo 'class="active"'; ?> href="<?php echo $this->createUrl($this->route, CMap::mergeArray($_GET, array('bbid'=>'')))?>">Все</a>
</div>
<div class="brandos">
<?php foreach($children as $child): ?>

<a <?php if(@$_GET['bbid']==$child->id) echo 'class="active"'; ?> href="<?php echo $this->createUrl($this->route, CMap::mergeArray($_GET, array('bbid'=>$child->id)))?>"><?php echo $child->name; ?></a>

<?php endforeach; ?>
</div>
</div>

<?php endif; ?>
<b class="clearb"></b>

        <?php
            if($category->hasChildren) {
                $this->renderPartial('_children', array(
                    'children'=>$category->children,
                    'category'=>$category,
                ));
            } elseif($category->hasProducts) {
                $this->renderPartial('_products', array(
                    'dataProvider'=>$dataProvider,
                    'category'=>$category,
                ));
            } else {
                echo '<div class="empty_category">Категория пуста.</div>';
            }
        ?>

    </div>
</div>
<div class="site_text">
    <?php //echo Yii::app()->config['main_text'];
    //echo $category->description ? $category->description : $brand->description;
    if($brand->seo) {
        echo $brand->seo;
    } else {
        echo $category->seo;
    }
    ?>
</div>

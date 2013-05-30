<?php
class ProductController extends Controller {

    public $layout='//layouts/column2';

    public function actionIndex($limit=20) {
        $_GET['limit']=$limit;

        $product=new Product('search');
        $product->unsetAttributes();  // clear any default values
        if(isset($_GET['Product']))
            $product->attributes=$_GET['Product'];

        $dataProvider=$product->search();
        $dataProvider->setPagination(array(
            'pageSize'=>$limit,
        ));
        $dataProvider->setSort(array(
            'defaultOrder'=>'t.sname ASC, t.price ASC',
            'sortVar'=>'sort',
        ));

        $this->breadcrumbs=array('Каталог');

        $this->metaTitle=Yii::app()->config['shop_name'].' - '.'Каталог';

        $dataProvider->getData();
        $this->render('index',array(
            'dataProvider'=>$dataProvider,
        ));
    }

    public function actionPromotion($limit=20) {
        $_GET['limit']=$limit;

        $product=new Product('search');
        $product->unsetAttributes();  // clear any default values
        if(isset($_GET['Product']))
            $product->attributes=$_GET['Product'];

        $product->in_promotion=1;

        $dataProvider=$product->search();
        $dataProvider->setPagination(array(
            'pageSize'=>$limit,
        ));
        $dataProvider->setSort(array(
            'defaultOrder'=>Yii::app()->config['product_catalog_order'],
            'sortVar'=>'sort',
        ));

        $this->breadcrumbs=array('Акции');

        $this->metaTitle=Yii::app()->config['shop_name'].' - '.'Акции';

        $dataProvider->getData();
        $this->render('promotion',array(
            'dataProvider'=>$dataProvider,
        ));
    }

    public function actionAccessory($limit=20) {
        $_GET['limit']=$limit;

        $product=new Product('search');
        $product->unsetAttributes();  // clear any default values
        if(isset($_GET['Product']))
            $product->attributes=$_GET['Product'];

        $product->accessory=1;

        $dataProvider=$product->search();
        $dataProvider->setPagination(array(
            'pageSize'=>$limit,
        ));
        $dataProvider->setSort(array(
            'defaultOrder'=>Yii::app()->config['product_catalog_order'],
            'sortVar'=>'sort',
        ));

        $this->breadcrumbs=array('Аксессуары');

        $this->metaTitle=Yii::app()->config['shop_name'].' - '.'Аксессуары';

        $dataProvider->getData();
        $this->render('accessory',array(
            'dataProvider'=>$dataProvider,
        ));
    }

    public function actionNew($limit=20) {
        $_GET['limit']=$limit;

        $product=new Product('search');
        $product->unsetAttributes();  // clear any default values

        $get = $_GET;
        unset($get['id']);
        if(isset($_GET['Product']))
            $product->attributes=$_GET['Product'];
        $product->attributes = $get;


        $product->novelty=1;

        $dataProvider=$product->search();
        $dataProvider->setPagination(array(
            'pageSize'=>$limit,
        ));
        $dataProvider->setSort(array(
            'defaultOrder'=>'create_time DESC'/*Yii::app()->config['product_catalog_order']*/,
            'sortVar'=>'sort',
        ));

        $this->breadcrumbs=array('Новинки');

        $this->metaTitle=Yii::app()->config['shop_name'].' - '.'Новинки';

        $dataProvider->getData();
        $this->render('new',array(
            'dataProvider'=>$dataProvider,
        ));
    }

    public function actionHit($limit=20) {
        $_GET['limit']=$limit;

        $product=new Product('search');
        $product->unsetAttributes();  // clear any default values
        if(isset($_GET['Product']))
            $product->attributes=$_GET['Product'];

        $product->hit=1;

        $dataProvider=$product->search();
        $dataProvider->setPagination(array(
            'pageSize'=>$limit,
        ));
        $dataProvider->setSort(array(
            'defaultOrder'=>Yii::app()->config['product_catalog_order'],
            'sortVar'=>'sort',
        ));

        $this->breadcrumbs=array('Спецпредложения');

        $this->metaTitle=Yii::app()->config['shop_name'].' - '.'Хит продаж';

        $dataProvider->getData();
        $this->render('hit',array(
            'dataProvider'=>$dataProvider,
        ));
    }

    public function actionView($id) {
		$product=$this->loadModel($id);

        $breadcrumbs=array($product->name);
        if($product->brand_id){
            //$breadcrumbs[$product->brand->name]=$product->brand->url;
            if($product->brand->parent){
                $breadcrumbs[$product->brand->name]=Yii::app()->createUrl('category/view', array('id'=>$product->category_id, 'Product[brand_id]'=>$product->brand->parent->id, 'bbid'=>$product->brand->id));
                $breadcrumbs[$product->brand->parent->name]=Yii::app()->createUrl('category/view', array('id'=>$product->category_id, 'Product[brand_id]'=>$product->brand->parent->id,));
            } else
                $breadcrumbs[$product->brand->name]=Yii::app()->createUrl('category/view', array('id'=>$product->category_id, 'Product[brand_id]'=>$product->brand->id,));
        }

        $c=$product->category;
        do {
            $breadcrumbs[$c->name]=$c->url;
        } while($c=$c->parent);

        $this->breadcrumbs=array_reverse($breadcrumbs);

        $this->metaTitle=Yii::app()->config['shop_name'].' - '.$product->brand->name.' '.$product->name;

        $this->render('view',array(
            'product'=>$product,
		));
    }

	public function loadModel($id)
	{
		$model=Product::model()->findByPk((int)$id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
}
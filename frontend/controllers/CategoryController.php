<?php
class CategoryController extends Controller {

    public $layout='//layouts/column1';

    public function actionIndex() {

    }

    public function actionView($id, $limit=60, $bbid=null) {
		$category=$this->loadModel($id);
        $_GET['limit']=$limit;

		$product=new Product('search');
		$product->unsetAttributes();  // clear any default values

        $get=$_GET;
        unset($get['id']);

		if(isset($_GET['Product'])) {
            $get=$_GET['Product'];
            if($bbid)
                $get['brand_id']=$bbid;

			//$product->attributes=$get;
        }

        $product->attributes=$get;


        $product->category_id=$category->id;

        $dataProvider=$product->search();
        $dataProvider->setPagination(array(
            'pageSize'=>$limit,
        ));
        $dataProvider->setSort(array(
            'defaultOrder'=>'t.sname ASC, t.price ASC',
            'sortVar'=>'sort',
        ));

        if(!empty($_GET['Product']['brand_id'])) {
            $brand=Brand::model()->findByPk((int)$_GET['Product']['brand_id']);
            if($bbid)
                $breadcrumbs=array(Brand::model()->findByPk($bbid)->name, $brand->name=>array('category/view', 'id'=>$id, 'Product[brand_id]'=>$brand->id), $category->name=>$category->url);
            else
                $breadcrumbs=array($brand->name, $category->name=>$category->url);
        } else
            $breadcrumbs=array($category->name);
        
        $c=$category;
        while($c=$c->parent)
            $breadcrumbs[$c->name]=$c->url;

        $this->breadcrumbs=array_reverse($breadcrumbs);
        $this->metaTitle=Yii::app()->config['shop_name'].' - '.$category->name;

        $dataProvider->getData();
        $this->render('view',array(
			'category'=>$category,
            'dataProvider'=>$dataProvider,
		));
    }

	public function loadModel($id)
	{
		$model=Category::model()->findByPk((int)$id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
}
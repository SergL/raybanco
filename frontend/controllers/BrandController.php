<?php
class BrandController extends Controller {

    public $layout='//layouts/column2';

    public function actionIndex() {

    }

    public function actionView($id, $limit=20) {
        $brand=$this->loadModel($id);
        $_GET['limit']=$limit;

        $product=new Product('search');
        $product->unsetAttributes();  // clear any default values
        if(isset($_GET['Product']))
            $product->attributes=$_GET['Product'];
        $product->brand_id=$brand->id;


        $dataProvider=$product->search();
        $dataProvider->setPagination(array(
            'pageSize'=>$limit,
        ));
        $dataProvider->setSort(array(
            'defaultOrder'=>Yii::app()->config['product_catalog_order'],
            'sortVar'=>'sort',
        ));

        if($brand->parent)
            $this->breadcrumbs = array($brand->parent->name=>Yii::app()->createUrl('brand/view', array('id'=>$brand->parent->id)), $brand->name);
        else
            $this->breadcrumbs=array($brand->name);

        $this->metaTitle=Yii::app()->config['shop_name'].' - '.$brand->name;

        $dataProvider->getData();
        $this->render('view',array(
            'brand'=>$brand,
            'dataProvider'=>$dataProvider,
        ));
    }


    /*public function actionView($id) {
        $brand=$this->loadModel($id);

        $this->breadcrumbs=array($brand->name);
        $this->metaTitle=Yii::app()->config['shop_name'].' - '.$brand->name;

        $this->render('view', array(
            'brand'=>$brand,
        ));
    } */

    public function loadModel($id)
    {
        $model=Brand::model()->findByPk((int)$id);
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }
}
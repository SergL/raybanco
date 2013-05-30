<?php
class SearchController extends Controller {

    public $layout='//layouts/column2';

    public function actionResult($query=null) {
        $product=new Product('search');
        $product->unsetAttributes();
        $product->query=$query;

        $dataProvider=$product->search();

        $dataProvider->setSort(array(
            'defaultOrder'=>Yii::app()->params['product_search_order'],
            'sortVar'=>'sort',
        ));
        $dataProvider->setPagination(array(
            'pageSize'=>700,
        ));

        $this->breadcrumbs=array(
            "Поиск '{$query}'"
        );

        $this->metaTitle=Yii::app()->config['shop_name']." - Поиск '{$query}'";

        $this->render('result',array(
            'dataProvider'=>$dataProvider,
            'query'=>$query,
        ));
    }

}
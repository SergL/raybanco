<?php
class NewsController extends Controller {

     public $layout='//layouts/column2';

    public function actionView($id) {
        $news=$this->loadModel($id);

        $this->breadcrumbs=array(
            'Новости'=>array('news/archive'),
            $news->title
        );
        $this->metaTitle=Yii::app()->config['shop_name'].' - '.$news->title;

        $this->render('view',array(
            'news'=>$news,
		));
    }

    public function actionArchive() {
        //$criteria=new CDbCriteria;
        //$criteria->compare('status', News::STATUS_PUBLISHED);

        $news=new News('search');
        if(isset($_GET['News'])) {
            $news->status=News::STATUS_PUBLISHED;
            $news->attributes=$_GET['News'];
        }




        $dataProvider=$news->search();

        $this->breadcrumbs=array(
            'Новости'
        );
        $this->metaTitle=Yii::app()->config['shop_name'].' - Новости';

        $this->render('archive',array(
            'dataProvider'=>$dataProvider,

		));
    }

	public function loadModel($id)
	{
        $criteria=new CDbCriteria;
        $criteria->addInCondition('status', array(News::STATUS_ARCHIVED, News::STATUS_PUBLISHED));
        $criteria->compare('id', (int)$id);
		$model=News::model()->find($criteria);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
}
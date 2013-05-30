<?php

class ArticleController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
        $article=$this->loadModel($id);
        $this->breadcrumbs=array(
            'Статьи'=>array('article/index'),
            $article->title
        );
        $this->metaTitle=Yii::app()->config['shop_name'].' - '.$article->title;

		$this->render('view',array(
			'article'=>$article,
		));
	}

    public function actionAview($id)
    {
        $article=$this->loadModel($id);
        echo $article->content;
        exit;
    }

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
        $this->breadcrumbs=array(
            'Статьи'
        );
        $this->metaTitle=Yii::app()->config['shop_name'].' - Статьи';

		$dataProvider=new CActiveDataProvider('Article');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Article::model()->findByPk((int)$id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
}

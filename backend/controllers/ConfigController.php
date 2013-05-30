<?php
/**
 * User: Taral
 * Date: 30.09.11
 * Time: 21:18
 */

class ConfigController extends Controller
{
	public $layout='/layouts/column2';

    public $menu=array(
        array('label'=>'Основные', 'url'=>array('index', 'section'=>'basic')),
       // array('label'=>'Изображения', 'url'=>array('index', 'section'=>'images')),
	  //  array('label'=>'Контент', 'url'=>array('index', 'section'=>'content')),
        array('label'=>'Страницы', 'url'=>array('index', 'section'=>'pages')),
       // array('label'=>'Интеграция', 'url'=>array('index', 'section'=>'integration')),
       // array('label'=>'Заказы', 'url'=>array('index', 'section'=>'order')),
        array('label'=>'Купоны на скидку', 'url'=>array('index', 'section'=>'coupons')),
    );

	public function filters()
	{
		return array(
			'accessControl',
		);
	}

	public function accessRules()
	{
		return array(
			array('allow', 'roles'=>array('admin')),
			array('deny', 'users'=>array('*')),
		);
	}

	public function actionIndex($section='basic')
	{
        $exist=false;
        foreach($this->menu as $item) {
            if($item['url']['section']==$section) {
                $this->breadcrumbs=array(
                    'Настройки'=>$this->createUrl('index'),
                    $item['label']
                );
                $exist=true;
            }
        }
        if($exist==false)
            throw new CHttpException(404,'The requested page does not exist.');

        $model=$this->loadModel();

      	$this->performAjaxValidation($model);

      	if(isset($_POST['Config']))
      	{
      		$model->attributes=$_POST['Config'];
      		if($model->save()) {
                Yii::app()->user->setFlash('success', "Изменения сохранены");
      		    $this->redirect(array('index', 'section'=>$section));
            }
      	}

      	$this->render($section, array(
    	    'model'=>$model,
      	));
	}

	public function loadModel()
	{
		$model=Config::model()->findByPk(1);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='config-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}

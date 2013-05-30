<?php

class SiteController extends Controller
{
    public $layout='//layouts/column2';
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

    public function actionEmail() {
        $email=new Email;
        $email->attributes=$_POST;
        $email->save();
        echo CHtml::errorSummary($email);
        exit;
    }

    public function actionPhone() {
        $email=new Phone;
        $email->attributes=$_POST;
        $email->save();
        echo CHtml::errorSummary($email);
        exit;
    }

	public function actionIndex()
	{
        $product=new Product('search');
        $product->unsetAttributes();  // clear any default values

        $product->shopwindow=1;
        if(isset($_GET['Product']))
            $product->attributes=$_GET['Product'];

        $dataProvider=$product->search();
        $dataProvider->setPagination(array(
            'pageSize'=>12,
        ));
        /*$dataProvider->setSort(array(
            'defaultOrder'=>'t.priority DESC',
            'sortVar'=>'sort',
        ));*/

        $criteria=$dataProvider->getCriteria();
        $criteria->order='t.priority DESC';
        $dataProvider->setCriteria($criteria);

        $this->layout='//layouts/main';
        $this->metaTitle=Yii::app()->name;
		$this->render('index', array(
            'dataProvider'=>$dataProvider,
        ));
	}

	public function actionError()
	{
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else {
                $this->breadcrumbs=array('Страницы не существует');
                $this->metaTitle=Yii::app()->name . ' - Страницы не существует';
	        	$this->render('error', $error);
            }
	    }
	}

	public function actionContact()
	{
		$contact=new ContactForm;

		if(isset($_POST['ContactForm']))
		{
			$contact->attributes=$_POST['ContactForm'];
			if($contact->validate())
			{
				$headers="From: {$contact->email}\r\nReply-To: {$contact->email}";
				mail(Yii::app()->config['contact_email'],$contact->subject,$contact->body,$headers);
				Yii::app()->user->setFlash('contact','Благодарим вас за обращение к нам. Мы ответим вам как можно скорее.');
				$this->refresh();
			}
		}

        $this->breadcrumbs=array('Контакты');
        $this->metaTitle=Yii::app()->name . ' - Контакты';

		$this->render('contact',array('contact'=>$contact));
	}

    public function actionCurrency($id) {
        $model=Currency::model()->findByPk((int)$id);
      	if($model===null)
      		throw new CHttpException(404,'The requested page does not exist.');
        Yii::app()->currency->setActive($model->id);
        $this->redirect(isset($_GET['returnUrl']) ? $_GET['returnUrl'] : array('site/index'));
    }

	public function actionLogin()
	{
		$login=new LoginForm;

		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($login);
			Yii::app()->end();
		}

		if(isset($_POST['LoginForm']))
		{
			$login->attributes=$_POST['LoginForm'];

			if($login->validate() && $login->login()){
                if(!empty($_GET['return_url']))
                    $this->redirect(array($_GET['return_url']));
                else
                    $this->redirect(Yii::app()->homeUrl);
            }
		}

        $this->breadcrumbs=array('Авторизация');
        $this->metaTitle=Yii::app()->name . ' - Авторизация';

        if(isset($_GET['return_url']) and $_GET['return_url']=='order/index')
            $this->render('cart_login',array('login'=>$login));
        else
            $this->render('login',array('login'=>$login));
	}

	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}
<?php
class UserController extends Controller {

    public $layout='//layouts/column2';

    public function actionLostpass() {
        if(isset($_POST['email'])) {
            $user=User::model()->find('email=?', array($_POST['email']));
            if($user) {

                $swift=Yii::app()->swiftMailer;
                $transport=$swift->mailTransport();
                $mailer=$swift->mailer($transport);

                $url=Yii::app()->createAbsoluteUrl('user/newpass', array('id'=>$user->id, 'key'=>md5($user->username.$user->id)));


                $body='Для того что бы сменить пароль перейдите <a href="'.$url.'">по ссылке</a>';

                $subject='Смена пароля в интернет магазине Ray Ban Co';

                $message = $swift->newMessage($subject)
                    ->setFrom(isset($_SERVER['HTTP_HOST'])?'noreply@'.$_SERVER['HTTP_HOST']:'sms@'.$_SERVER['SERVER_NAME'])
                    ->setTo($user->email)
                    ->setBody($body, 'text/html');

                $mailer->send($message);

                Yii::app()->user->setFlash('lostpass', 'Инструкция по восстановлению пароля выслана Вам на почту.');
            } else {
                Yii::app()->user->setFlash('lostpass_error', 'Пользователь с такой электронной почтой отсутствует.');
            }
        }

        $this->render('lostpass');
    }

    public function actionNewpass($id, $key) {

        $user=User::model()->findByPk($id);

        if($user===null || md5($user->username.$user->id)!=$key)
            throw new CHttpException(404,'The requested page does not exist.');

        $password=substr(md5(rand()),0,6);

        $user->password=$user->hashPassword($password);
        $user->save();


        $this->render('newpass', array(
            'model'=>$user,
            'password'=>$password,
        ));
    }


    public function actionRegister() {
        $user=new User('register');

        $this->performAjaxValidation($user);

        if(isset($_POST['User'])) {
            $user->attributes=$_POST['User'];
            $user->role=User::ROLE_CLIENT;
            $user->status=User::STATUS_ENABLED;
            if($user->save()) {
                $this->sendMail($user);
                //$this->onRegister(new CEvent($user));
                Yii::app()->user->setFlash('register',Yii::app()->config['user_register_text']);
                $this->refresh();
            }
        }

        $this->breadcrumbs=array('Регистрация');

        $this->metaTitle=Yii::app()->config['shop_name'].' - Регистрация';

        $this->render('register', array(
            'user'=>$user
        ));
    }

    public function actionUpdate()
   	{

        $model=$this->loadModel();

        if(!empty($_POST['changePassword']))
           $model->scenario='changePassword';

        // Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($model);

        if(isset($_POST['User']))
        {

            if(isset($_POST['User']['role'])) unset($_POST['User']['role']);
            if(isset($_POST['User']['status'])) unset($_POST['User']['status']);
            if(isset($_POST['User']['comment'])) unset($_POST['User']['comment']);

            $model->attributes=$_POST['User'];

            if($model->save()) {
               Yii::app()->user->setFlash('success', "Изменения сохранены");
               $this->refresh();
            }
        }

        $this->render('update',array(
            'model'=>$model,
        ));
   	}


    public function actionSubscription()
   	{
        $model=$this->loadModel();

        if(!empty($_POST['changePassword']))
           $model->scenario='changePassword';

        // Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($model);

        if(isset($_POST['User']))
        {
            if(isset($_POST['User']['role'])) unset($_POST['User']['role']);
            if(isset($_POST['User']['status'])) unset($_POST['User']['status']);
            if(isset($_POST['User']['comment'])) unset($_POST['User']['comment']);

            $model->attributes=$_POST['User'];
            if($model->save()) {
               Yii::app()->user->setFlash('success', "Изменения сохранены");
               $this->refresh();
            }
        }

        $this->render('subscription',array(
            'model'=>$model,
        ));
   	}

    /*public function onRegister(CEvent $event) {
        $this->raiseEvent('onRegister', $event);
    }*/

	public function loadModel()
	{
		$model=User::model()->findByPk(Yii::app()->user->id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

    private function sendMail($user){
        $config=Yii::app()->config;
        $swift=Yii::app()->swiftMailer;
        $transport=$swift->mailTransport();
        $mailer=$swift->mailer($transport);

        $swift=Yii::app()->swiftMailer;
        $transport=$swift->mailTransport();
        $mailer=$swift->mailer($transport);

        $url=Yii::app()->createAbsoluteUrl('user/confirmation', array('id'=>$user->id, 'key'=>md5($user->username.$user->id)));


        $body='
С радостью сообщаем, что ваш запрос на регистрацию на сайте “Jewel Mag” принят.<br>
   Теперь вы можете совершать покупки на нашем сайте <br><br>
   С наилучшими пожеланиями,<br>
   Обращайтесь. Будем рады каждому вашему звонку';

        $subject='Регистрации в интернет магазине «Ray Ban Co»';

        $message = $swift->newMessage($subject)
            ->setFrom(isset($_SERVER['HTTP_HOST'])?'noreply@'.$_SERVER['HTTP_HOST']:'sms@'.$_SERVER['SERVER_NAME'])
            ->setTo($user->email)
            ->setBody($body, 'text/html');

        $mailer->send($message);

    }
}
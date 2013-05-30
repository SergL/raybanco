<?php
class Controller extends CController {

	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='/layouts/column2';
    public $assetsUrl='';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();

    public $topMenu;
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();

	public function init()
	{
        $config=require Yii::getPathOfAlias('common.config.handlers').'.php';
        foreach($config as $event=>$handlers) {
            if($this->hasEvent($event)) {
                foreach($handlers as $handler) {
                    $this->attachEventHandler($event, $handler);
                }
            }
        }

        if(isset($_POST['PHPSESSID'])) {
            Yii::app()->session->close();
            Yii::app()->session->sessionID = $_POST['PHPSESSID'];
            Yii::app()->session->init();
        }

        $dir = dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'assets';
        $this->assetsUrl=Yii::app()->assetManager->publish($dir, false, -1, YII_DEBUG);

        parent::init();
	}

    public function beforeRender($view) {
        if(parent::beforeRender($view)) {
            if($this->topMenu===null)
                $this->topMenu=include Yii::getPathOfAlias('application.config.topMenu').'.php';

            return true;
        } else {
            return false;
        }
    }

    public function getIsSimplePassword() {
        if(Yii::app()->user->isGuest || YII_DEBUG) {
            return false;
        }
        $user=User::model()->findByPk(Yii::app()->user->id);

        $simples=array(
            'demo', '123456', '12345','111111','123456789','qwerty',
            '123321','7777777','666666','1234567','123123','654321',
            '000000','555555','55555','11111','1234567890','121212','12345678','159753',
            '1q2w3e','777777','123654','222222','gfhjkm','112233', '123123',
        );

        foreach($simples as $simple) {
            if($user->validatePassword($simple)) {
                return true;
            }
        }

        if($user->validatePassword($user->username)) {
            return true;
        }

        return false;
    }
}
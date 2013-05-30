<?php
class SeoController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout='/layouts/column2';

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array('allow', 'roles'=>array('content')),
            array('deny', 'users'=>array('*')),
        );
    }

    public function actionIndex() {
        $models=$this->getModelsToUpdate();
        if(isset($_POST['SEO'])) {
            $valid=true;
            foreach($models as $i=>$model) {
                if(isset($_POST['SEO'][$i]))
                    $model->attributes=$_POST['SEO'][$i];
                $valid=$model->validate() && $valid;
            }
            if($valid) {
                foreach($models as $i=>$model)
                    $model->save();

                Yii::app()->user->setFlash('success', "Изменения сохранены");
                $this->redirect(array('index'));
            }
        }
        $this->render('index', array(
            'models'=>$models
        ));
    }

    public function getModelsToUpdate() {
        $criteria=new CDbCriteria;
        $criteria->join='JOIN {{lookup}} as t2 ON t2.code=t.route';
        $criteria->order='t2.position';
        return SEO::model()->findAll($criteria);
    }
}
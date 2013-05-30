<?php
class Phone extends CActiveRecord {

    public static function model($className=__CLASS__)
   	{
   		return parent::model($className);
   	}

    public function behaviors(){
  	    return array(
  		    'CTimestampBehavior' => array(
  		  	    'class' => 'zii.behaviors.CTimestampBehavior',
  		  	    'createAttribute' => 'create_time',
  			    'updateAttribute' => false,
  		    )
  	    );
    }

    public function tableName()
   	{
   		return '{{phone}}';
   	}


    public function rules()
   	{
   		// NOTE: you should only define rules for those attributes that
   		// will receive user inputs.
   		return array(
               array('phone', 'filter', 'filter'=>'strip_tags'),
               array('phone', 'unique'),
   		);
   	}

    public function attributeLabels()
   	{
   		return array(
   			'phone' => 'Телефон',
   		);
   	}
}
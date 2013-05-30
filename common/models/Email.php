<?php
class Email extends CActiveRecord {

    public static function model($className=__CLASS__)
   	{
   		return parent::model($className);
   	}

    public function tableName()
   	{
   		return '{{email}}';
   	}


    public function rules()
   	{
   		// NOTE: you should only define rules for those attributes that
   		// will receive user inputs.
   		return array(
               array('email', 'filter', 'filter'=>'strip_tags'),
               array('email', 'email'),
               array('email', 'unique'),
   		);
   	}

    public function attributeLabels()
   	{
   		return array(
   			'email' => 'Ел. почта',
   		);
   	}
}
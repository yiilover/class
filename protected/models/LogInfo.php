<?php

/**
 * This is the model class for table "log_info".
 *
 * The followings are the available columns in table 'log_info':
 * @property integer $log_id
 * @property string $log_title
 * @property string $log_content
 * @property integer $admin_id
 * @property string $log_time
 */
class LogInfo extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return LogInfo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'log_info';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('log_title, log_content, admin_id, log_time', 'required'),
			array('admin_id', 'numerical', 'integerOnly'=>true),
			array('log_title', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('log_id, log_title, log_content, admin_id, log_time', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'log_id' => 'Log',
			'log_title' => 'Log Title',
			'log_content' => 'Log Content',
			'admin_id' => 'Admin',
			'log_time' => 'Log Time',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('log_id',$this->log_id);
		$criteria->compare('log_title',$this->log_title,true);
		$criteria->compare('log_content',$this->log_content,true);
		$criteria->compare('admin_id',$this->admin_id);
		$criteria->compare('log_time',$this->log_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
<?php

/**
 * This is the model class for table "sys_notice".
 *
 * The followings are the available columns in table 'sys_notice':
 * @property integer $sysnotice_id
 * @property string $sysnotice_content
 * @property string $sysnotice_time
 * @property integer $admin_id
 */
class SysNotice extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return SysNotice the static model class
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
		return 'sys_notice';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sysnotice_content, sysnotice_time, admin_id', 'required'),
			array('admin_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('sysnotice_id, sysnotice_content, sysnotice_time, admin_id', 'safe', 'on'=>'search'),
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
			'sysnotice_id' => 'Sysnotice',
			'sysnotice_content' => 'Sysnotice Content',
			'sysnotice_time' => 'Sysnotice Time',
			'admin_id' => 'Admin',
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

		$criteria->compare('sysnotice_id',$this->sysnotice_id);
		$criteria->compare('sysnotice_content',$this->sysnotice_content,true);
		$criteria->compare('sysnotice_time',$this->sysnotice_time,true);
		$criteria->compare('admin_id',$this->admin_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
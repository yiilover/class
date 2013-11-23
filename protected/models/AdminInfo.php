<?php

/**
 * This is the model class for table "admin_info".
 *
 * The followings are the available columns in table 'admin_info':
 * @property integer $admin_id
 * @property string $admin_name
 * @property string $admin_login_name
 * @property string $admin_login_password
 * @property integer $admin_role
 * @property integer $college_id
 */
class AdminInfo extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return AdminInfo the static model class
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
		return 'admin_info';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('admin_name, admin_login_name, admin_login_password, college_id', 'required'),
			array('admin_role, college_id', 'numerical', 'integerOnly'=>true),
			array('admin_name, admin_login_name, admin_login_password', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('admin_id, admin_name, admin_login_name, admin_login_password, admin_role, college_id', 'safe', 'on'=>'search'),
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
			'admin_id' => 'Admin',
			'admin_name' => 'Admin Name',
			'admin_login_name' => 'Admin Login Name',
			'admin_login_password' => 'Admin Login Password',
			'admin_role' => 'Admin Role',
			'college_id' => 'College',
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

		$criteria->compare('admin_id',$this->admin_id);
		$criteria->compare('admin_name',$this->admin_name,true);
		$criteria->compare('admin_login_name',$this->admin_login_name,true);
		$criteria->compare('admin_login_password',$this->admin_login_password,true);
		$criteria->compare('admin_role',$this->admin_role);
		$criteria->compare('college_id',$this->college_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
<?php

/**
 * This is the model class for table "user_info".
 *
 * The followings are the available columns in table 'user_info':
 * @property integer $user_id
 * @property string $user_name
 * @property integer $user_sex
 * @property integer $user_class_id
 * @property integer $user_is_manager
 * @property string $user_email
 * @property string $user_phone
 * @property string $user_address
 * @property string $user_login_name
 * @property string $user_login_password
 * @property integer $user_age
 * @property string $user_nation
 * @property string $user_native
 * @property string $user_remark
 * @property string $user_photo
 * @property string $user_number
 */
class UserInfo extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return UserInfo the static model class
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
		return 'user_info';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_name, user_sex, user_class_id, user_is_manager, user_email, user_phone, user_address, user_login_name, user_login_password, user_age, user_nation, user_native, user_remark, user_photo, user_number', 'required'),
			array('user_sex, user_class_id, user_is_manager, user_age', 'numerical', 'integerOnly'=>true),
			array('user_name, user_email, user_address, user_login_name, user_login_password', 'length', 'max'=>255),
			array('user_phone', 'length', 'max'=>11),
			array('user_nation', 'length', 'max'=>2),
			array('user_native', 'length', 'max'=>32),
			array('user_photo', 'length', 'max'=>50),
			array('user_number', 'length', 'max'=>12),
			array('image', 'file', 'allowEmpty'=>true, 'types'=>'jpg, gif, png','maxSize'=>1024 * 1024 * 1, // 1MB
			'tooLarge'=>'图片大小不超过1M','on'=>'addMember'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('user_id, user_name, user_sex, user_class_id, user_is_manager, user_email, user_phone, user_address, user_login_name, user_login_password, user_age, user_nation, user_native, user_remark, user_photo, user_number', 'safe', 'on'=>'search'),
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
			'class'=>array(self::BELONGS_TO,'ClassInfo','user_class_id')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'user_id' => 'User',
			'user_name' => 'User Name',
			'user_sex' => 'User Sex',
			'user_class_id' => 'User Class',
			'user_is_manager' => 'User Is Manager',
			'user_email' => 'User Email',
			'user_phone' => 'User Phone',
			'user_address' => 'User Address',
			'user_login_name' => 'User Login Name',
			'user_login_password' => 'User Login Password',
			'user_age' => 'User Age',
			'user_nation' => 'User Nation',
			'user_native' => 'User Native',
			'user_remark' => 'User Remark',
			'user_photo' => 'User Photo',
			'user_number' => 'User Number',
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
		
		//将表单传递过来的班级名转化为班级ID
		if(!empty($_GET["UserInfo"]["user_class_id"])){
			
			$string = $_GET['UserInfo']['user_class_id'];
		
			$class = Yii::app()->db->createCommand()
				    ->select('class_id')
				    ->from('class_info')
				    ->where("class_name like '%$string%'")
				    ->queryAll();
			$class_id = CHtml::listData($class,'class_id','class_id');
			    
			
		}else{
		
			$class_id = '';
		
		
		}
		
		//将表单传递过来的性别男或女转换成0或1
		if(!empty($_GET["UserInfo"]["user_sex"])){
			
			$string = $_GET['UserInfo']['user_sex'];
			
			switch ($string){
			
				case '男':$sex=0;
				break;
				case '女':$sex=1;
				break;
				default:$sex=null;
			}
		}else{
		
			$sex = array(0,1);
		
		}
		/*保证查询的用户为本系班级成员*/
		$adminModel = AdminInfo::model()->findByPk(Yii::app()->user->id);
		$sql = "select class_id from class_info where college_id=".$adminModel->college_id;
		$classArr = ClassInfo::model()->findAllBySql($sql);
		$classIdStr='';
		foreach($classArr as $value){
			$classIdStr .=$value->class_id.","; 
		}
		$classIdStr=substr($classIdStr,0,-1);
		
		
		$criteria=new CDbCriteria;
		$criteria->addCondition("user_class_id IN ($classIdStr)");
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('user_name',$this->user_name,true);
		$criteria->compare('user_sex',$sex);
		$criteria->compare('user_class_id',$class_id);
		$criteria->compare('user_is_manager',$this->user_is_manager);
		$criteria->compare('user_email',$this->user_email,true);
		$criteria->compare('user_phone',$this->user_phone,true);
		$criteria->compare('user_address',$this->user_address,true);
		$criteria->compare('user_login_name',$this->user_login_name,true);
		$criteria->compare('user_login_password',$this->user_login_password,true);
		$criteria->compare('user_age',$this->user_age);
		$criteria->compare('user_nation',$this->user_nation,true);
		$criteria->compare('user_native',$this->user_native,true);
		$criteria->compare('user_remark',$this->user_remark,true);
		$criteria->compare('user_photo',$this->user_photo,true);
		$criteria->compare('user_number',$this->user_number,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
		        'pageSize'=>20
		)
		));
		
		/*
		$criteria=new CDbCriteria;

		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('user_name',$this->user_name,true);
		$criteria->compare('user_sex',$this->user_sex);
		$criteria->compare('user_class_id',$this->user_class_id);
		$criteria->compare('user_is_manager',$this->user_is_manager);
		$criteria->compare('user_email',$this->user_email,true);
		$criteria->compare('user_phone',$this->user_phone,true);
		$criteria->compare('user_address',$this->user_address,true);
		$criteria->compare('user_login_name',$this->user_login_name,true);
		$criteria->compare('user_login_password',$this->user_login_password,true);
		$criteria->compare('user_age',$this->user_age);
		$criteria->compare('user_nation',$this->user_nation,true);
		$criteria->compare('user_native',$this->user_native,true);
		$criteria->compare('user_remark',$this->user_remark,true);
		$criteria->compare('user_photo',$this->user_photo,true);
		$criteria->compare('user_number',$this->user_number,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));*/
	}
}
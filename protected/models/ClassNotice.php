<?php

/**
 * This is the model class for table "class_notice".
 *
 * The followings are the available columns in table 'class_notice':
 * @property integer $class_notice_id
 * @property string $class_notice_content
 * @property string $class_notice_time
 * @property integer $class_id
 * @property integer $admin_id
 * @property integer $class_notice_type
 */
class ClassNotice extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return ClassNotice the static model class
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
		return 'class_notice';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('class_notice_content, class_notice_time, class_id, admin_id, class_notice_type', 'required'),
			array('class_id, admin_id, class_notice_type', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('class_notice_id, class_notice_content, class_notice_time, class_id, admin_id, class_notice_type', 'safe', 'on'=>'search'),
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
		
			"class"=>array(self::BELONGS_TO,"ClassInfo","class_id"),
			"admin"=>array(self::BELONGS_TO,"AdminInfo","admin_id")
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'class_notice_id' => 'Class Notice',
			'class_notice_content' => 'Class Notice Content',
			'class_notice_time' => 'Class Notice Time',
			'class_id' => 'Class',
			'admin_id' => 'Admin',
			'class_notice_type' => 'Class Notice Type',
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
		
		/*保证查询通知为本系班级通知*/
		$adminModel = AdminInfo::model()->findByPk(Yii::app()->user->id);
		$sql = "select class_id from class_info where college_id=".$adminModel->college_id;
		$classArr = ClassInfo::model()->findAllBySql($sql);
		$classIdStr='';
		foreach($classArr as $value){
			$classIdStr .=$value->class_id.","; 
		}
		$classIdStr=substr($classIdStr,0,-1);
		$criteria=new CDbCriteria;
		$criteria->addCondition("class_id IN ($classIdStr)");
		$criteria->compare('class_notice_id',$this->class_notice_id);
		$criteria->compare('class_notice_content',$this->class_notice_content,true);
		$criteria->compare('class_notice_time',$this->class_notice_time,true);
		$criteria->compare('class_id',$this->class_id);
		$criteria->compare('admin_id',$this->admin_id);
		$criteria->compare('class_notice_type',$this->class_notice_type);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
		        'pageSize'=>20,
		    	),
		    'sort'=>array('defaultOrder'=>'class_notice_time desc'),
		));
	}
}
<?php

/**
 * This is the model class for table "class_message".
 *
 * The followings are the available columns in table 'class_message':
 * @property integer $class_message_id
 * @property integer $class_id
 * @property string $class_message_title
 * @property string $class_message_content
 * @property string $class_message_time
 * @property string $class_message_comefrom
 * @property integer $class_message_examine
 */
class ClassMessage extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return ClassMessage the static model class
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
		return 'class_message';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('class_id, class_message_title, class_message_content, class_message_time, class_message_comefrom, class_message_examine', 'required'),
			array('class_id, class_message_examine', 'numerical', 'integerOnly'=>true),
			array('class_message_title, class_message_comefrom', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('class_message_id, class_id, class_message_title, class_message_content, class_message_time, class_message_comefrom, class_message_examine', 'safe', 'on'=>'search'),
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
		
		"class"=>array(self::BELONGS_TO,'ClassInfo','class_id'),
		"message"=>array(self::HAS_ONE,'ClassMessageReply',"class_message_reply_id")
		
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'class_message_id' => 'Class Message',
			'class_id' => 'Class',
			'class_message_title' => 'Class Message Title',
			'class_message_content' => 'Class Message Content',
			'class_message_time' => 'Class Message Time',
			'class_message_comefrom' => 'Class Message Comefrom',
			'class_message_examine' => 'Class Message Examine',
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
		
		/*保证查询留言为本系班级留言*/
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
		$criteria->compare('class_message_id',$this->class_message_id);
		$criteria->compare('class_id',$this->class_id);
		$criteria->compare('class_message_title',$this->class_message_title,true);
		$criteria->compare('class_message_content',$this->class_message_content,true);
		$criteria->compare('class_message_time',$this->class_message_time,true);
		$criteria->compare('class_message_comefrom',$this->class_message_comefrom,true);
		$criteria->compare('class_message_examine',$this->class_message_examine);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
		        'pageSize'=>20,
		    	),
		    'sort'=>array('defaultOrder'=>'class_message_time desc'),
		));
	}
}
<?php

/**
 * This is the model class for table "class_message_reply".
 *
 * The followings are the available columns in table 'class_message_reply':
 * @property integer $class_message_reply_id
 * @property string $class_message_reply_content
 * @property string $class_message_reply_time
 * @property integer $admin_id
 * @property integer $class_message_id
 */
class ClassMessageReply extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return ClassMessageReply the static model class
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
		return 'class_message_reply';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('class_message_reply_content, class_message_reply_time, admin_id, class_message_id', 'required'),
			array('admin_id, class_message_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('class_message_reply_id, class_message_reply_content, class_message_reply_time, admin_id, class_message_id', 'safe', 'on'=>'search'),
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
			'class_message_reply_id' => 'Class Message Reply',
			'class_message_reply_content' => 'Class Message Reply Content',
			'class_message_reply_time' => 'Class Message Reply Time',
			'admin_id' => 'Admin',
			'class_message_id' => 'Class Message',
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

		$criteria->compare('class_message_reply_id',$this->class_message_reply_id);
		$criteria->compare('class_message_reply_content',$this->class_message_reply_content,true);
		$criteria->compare('class_message_reply_time',$this->class_message_reply_time,true);
		$criteria->compare('admin_id',$this->admin_id);
		$criteria->compare('class_message_id',$this->class_message_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
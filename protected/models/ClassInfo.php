<?php

/**
 * This is the model class for table "class_info".
 *
 * The followings are the available columns in table 'class_info':
 * @property integer $class_id
 * @property string $class_name
 * @property integer $class_size
 * @property integer $college_id
 * @property string $class_grade
 */
class ClassInfo extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return ClassInfo the static model class
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
		return 'class_info';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('class_name, class_size, college_id, class_grade', 'required'),
			array('class_size, college_id', 'numerical', 'integerOnly'=>true),
			array('class_name', 'length', 'max'=>255),
			array('class_grade', 'length', 'max'=>8),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('class_id, class_name, class_size, college_id, class_grade', 'safe', 'on'=>'search'),
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
			'class_id' => 'Class',
			'class_name' => 'Class Name',
			'class_size' => 'Class Size',
			'college_id' => 'College',
			'class_grade' => 'Class Grade',
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
		$model = AdminInfo::model()->findByPk(Yii::app()->user->id);
		$criteria=new CDbCriteria;
		$criteria->condition='college_id='.$model->college_id;
		$criteria->compare('class_id',$this->class_id);
		$criteria->compare('class_name',$this->class_name,true);
		$criteria->compare('class_size',$this->class_size);
		$criteria->compare('college_id',$this->college_id);
		$criteria->compare('class_grade',$this->class_grade,true);
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
		        'pageSize'=>20,
		    	),
		));
	}
}
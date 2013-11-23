<?php

class ClassController extends Controller
{	
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	
	
	*/
	
	
	//首页（所有班级列表）
	public function actionIndex()
	{
		
		$model=new ClassInfo('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['ClassInfo']))
			$model->attributes=$_GET['ClassInfo'];

		$this->render('index',array('model'=>$model));
		
	}
	//添加班级
	public function actionAddClass(){
		
		
	$model=new ClassInfo();
	if(isset($_POST['ClassInfo'])){
		
		$collegeModel = AdminInfo::model()->findByPk(Yii::app()->user->id);
		
		$grade=$_POST['ClassInfo']['class_grade'];
		$LocalDate=getdate();
		$LocalYear = $LocalDate['year'];
		
		switch ($grade){
		
			case 0 : $class_grade=$LocalYear;
			break;
			case 1 : $class_grade=$LocalYear-1;
			break;
			case 2 : $class_grade=$LocalYear-2;
			break;
			case 3 : $class_grade=$LocalYear-3;
			break;
			case 4 : $class_grade=$LocalYear-4;
			break;
			default: $class_grade='';
		}
		
		$checkModel = ClassInfo::model()->find('class_name=:class_name and class_grade=:class_grade',array("class_name"=>$_POST['ClassInfo']['class_name'],"class_grade"=>$class_grade));
		if($checkModel){
		
			echo "<script type='text/javascript'>alert('班级已存在！')</script>";
			//echo "<script type='text/javascript'>location.href='index.php?r=class/index'</script>";
			
		}else{ 
			
			$model->class_name=$_POST['ClassInfo']['class_name'];
			$model->class_size=$_POST['ClassInfo']['class_size'];
			$model->college_id=$collegeModel->college_id;
			$model->class_grade=$class_grade;
			
			if($model->save()){
			
				/*写添加班级日志*/
				$log = new LogInfo();
				$log->admin_id = Yii::app()->user->id;
				$log->log_content = AdminInfo::model()->findByPk(Yii::app()->user->id)->admin_name."添加班级:".$model->class_name;
				$log->log_title = "AddClass";
				$log->log_time = date("Y-m-d H:i:s");
				$log->save(false);
				echo "<script type='text/javascript'>alert('添加班级成功！')</script>";
				echo "<script type='text/javascript'>location.href='index.php?r=class/index'</script>";
			
			
			}
		}
	}
		$this->render('add',array('model'=>$model));
	}
	
	//查看班级信息(查看班级所有成员)
	public function actionView(){
		
		
		/*保证查询的用户为本系班级成员*/
		$adminModel = AdminInfo::model()->findByPk(Yii::app()->user->id);
		$sql = "select class_id from class_info where college_id=".$adminModel->college_id;
		$classArr = ClassInfo::model()->findAllBySql($sql);
		$classIdStr='';
		foreach($classArr as $value){
			$classIdStr .=$value->class_id.","; 
		}
		$classIdStr=substr($classIdStr,0,-1);
		
		$model = new UserInfo();
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['UserInfo'])){
			
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
			
			$model->attributes=$_GET['UserInfo'];
			$criteria=new CDbCriteria();
			$criteria->addCondition("user_class_id IN ($classIdStr)"); /*保证查询的用户为本系班级成员*/
			$criteria->addCondition("user_class_id=".$_GET['id']); /*保证查询的用户为本班成员*/
			
			$criteria->compare('user_name',$_GET['UserInfo']['user_name'],true);
			$criteria->compare('user_sex',$sex);
			$criteria->compare('user_class_id',$class_id);
			$criteria->compare('user_number',$_GET['UserInfo']['user_number'],true);
			$dataProvider =  new CActiveDataProvider("UserInfo", array(
						'criteria'=>$criteria,
						'pagination'=>array(
					        'pageSize'=>20
					)
					));
			
		}else{
		
			$criteria=new CDbCriteria();
			$criteria->addCondition("user_class_id IN ($classIdStr)"); /*保证查询的用户为本系班级成员*/
			$criteria->addCondition("user_class_id=".$_GET['id']); /*保证查询的用户为本班成员*/
			$dataProvider =  new CActiveDataProvider("UserInfo", array(
						'criteria'=>$criteria,
						'pagination'=>array(
					        'pageSize'=>20
					)
					));
		}	
		$this->render('view',array('data'=>$dataProvider,'model'=>$model));		
				
				
				
	}

	//更新班级信息
	public function  actionUpdate(){
	
		$model=ClassInfo::model()->findBypk($_GET['id']);
		if(isset($_POST['ClassInfo'])){
			
					$grade=$_POST['ClassInfo']['class_grade'];
					$LocalDate=getdate();
					$LocalYear = $LocalDate['year'];
					
					switch ($grade){
					
						case 0 : $class_grade=$LocalYear;
						break;
						case 1 : $class_grade=$LocalYear-1;
						break;
						case 2 : $class_grade=$LocalYear-2;
						break;
						case 3 : $class_grade=$LocalYear-3;
						break;
						case 4 : $class_grade=$LocalYear-4;
						break;
						default: $class_grade='';
					}
					$model->class_name = $_POST['ClassInfo']['class_name'];
					$model->class_size = $_POST['ClassInfo']['class_size'];
					$model->class_grade=$class_grade;
					
			if($model->save()){
			
				/*写修改班级日志*/
				$log = new LogInfo();
				$log->admin_id = Yii::app()->user->id;
				$log->log_content = AdminInfo::model()->findByPk(Yii::app()->user->id)->admin_name."修改".$model->class_name."信息成功！";
				$log->log_title = "UpdateClass";
				$log->log_time = date("Y-m-d H:i:s");
				$log->save(false);
			echo "<script type='text/javascript'>alert('修改班级信息成功！')</script>";
			echo "<script type='text/javascript'>location.href='index.php?r=class/index'</script>";
			
			
			}
				
		}
			$this->render("update",array("model"=>$model));
	}
	//删除已毕业班级
	public function actionDelete(){
	
	
	$model=ClassInfo::model()->findBypk($_GET['id']);
	$model->delete();
	/*写删除班级日志*/
				$log = new LogInfo();
				$log->admin_id = Yii::app()->user->id;
				$log->log_content = AdminInfo::model()->findByPk(Yii::app()->user->id)->admin_name."删除".$model->class_name."成功！";
				$log->log_title = "DeleteClass";
				$log->log_time = date("Y-m-d H:i:s");
				$log->save(false);
	
	
	}
	
}
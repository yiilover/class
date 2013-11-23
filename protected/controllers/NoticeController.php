<?php

class NoticeController extends Controller
{
	public function actionIndex()
	{
		$model = new ClassNotice('search');
		$model->unsetAttributes();  // clear any default values
		
		if(isset($_GET['ClassNotice']))
			$model->attributes=$_GET['ClassNotice'];
		$this->render('index',array('model'=>$model));
	}

	public function actionAdd(){
	
		
		$model = new ClassNotice();
		
		if(isset($_POST['ClassNotice'])){
		
		
			$model->attributes = $_POST['ClassNotice'];
			$model->admin_id = Yii::app()->user->id;
			$model->class_notice_time = date("Y-m-d H:i:s");
			
			if($model->save(false)){
			
				/*写添加公告日志*/
				$log = new LogInfo();
				$log->admin_id = Yii::app()->user->id;
				$log->log_content = AdminInfo::model()->findByPk(Yii::app()->user->id)->admin_name."添加公告".$model->class_notice_id."成功！";
				$log->log_title = "AddNotice";
				$log->log_time = date("Y-m-d H:i:s");
				$log->save(false);
				echo "<script type='text/javascript'>alert('新增系统公告成功')</script>";
				echo "<script type='text/javascript'>location.href = 'index.php?r=notice/index'</script>";

			
			}
		}
		
		$this->render('add',array('model'=>$model));
	}
	
	
	
	public function actionView(){
		
		$model = ClassNotice::model()->findByPk($_GET['id']);
	
		$this->render('view',array('model'=>$model));

	}
	
	public function actionUpdate(){
		
		
		$model = ClassNotice::model()->findByPk($_GET['id']);
		
		if(isset($_POST['ClassNotice'])){
		
		
			$model->attributes = $_POST['ClassNotice'];
			$model->admin_id = Yii::app()->user->id;
			$model->class_notice_time = date("Y-m-d H:i:s");
			
			if($model->save(false)){
			
				/*写修改公告日志*/
				$log = new LogInfo();
				$log->admin_id = Yii::app()->user->id;
				$log->log_content = AdminInfo::model()->findByPk(Yii::app()->user->id)->admin_name."修改公告".$model->class_notice_id."成功！";
				$log->log_title = "UpdateNotice";
				$log->log_time = date("Y-m-d H:i:s");
				$log->save(false);
				echo "<script type='text/javascript'>alert('修改系统公告成功')</script>";
				echo "<script type='text/javascript'>location.href = 'index.php?r=notice/index'</script>";

			
			}
		}
		
		$this->render('update',array('model'=>$model));
	
	}
	public function actionDelete(){
	
	
		$model = ClassNotice::model()->findByPk($_GET['id']);
		$model->delete();
		/*写删除公告日志*/
				$log = new LogInfo();
				$log->admin_id = Yii::app()->user->id;
				$log->log_content = AdminInfo::model()->findByPk(Yii::app()->user->id)->admin_name."删除公告".$model->class_notice_id."成功！";
				$log->log_title = "DeleteNotice";
				$log->log_time = date("Y-m-d H:i:s");
				$log->save(false);
	}

	
}
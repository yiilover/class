<?php

class MessageController extends Controller
{
	public function actionIndex()
	{	
		
		$model=new ClassMessage('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['ClassMessage']))
			$model->attributes=$_GET['ClassMessage'];

		$this->render('index',array('model'=>$model));
		
		/*
			$adminModel = AdminInfo::model()->findByPk(Yii::app()->user->id);
			$sql = "select class_id from class_info where college_id=".$adminModel->college_id;
			$classArr = ClassInfo::model()->findAllBySql($sql);
			$classIdStr='';
			foreach($classArr as $value){
				$classIdStr .=$value->class_id.","; 
			}
			$classIdStr=substr($classIdStr,0,-1);
			$criteria = new CDbCriteria;
			$criteria->addCondition("class_id IN ($classIdStr)");
			$dataProvider = new CActiveDataProvider('ClassMessage',array(
				'criteria'=>$criteria,
				'pagination'=>array(
			        'pageSize'=>20,
			    	),
			    'sort'=>array('defaultOrder'=>'class_message_time desc'),
				)
			);
		$this->render('index',array('data'=>$dataProvider));
	*/
	}
	
	public function actionView(){
	
	
		$model = ClassMessage::model()->findByPk($_GET['id']);
		
		if(!empty($_POST['sub'])){
		
		
			$examine = $_POST['examine'];
			$reply = $_POST['text'];
			if(($reply != '无' || $reply != '') && $examine == 2){
				
					$examine = 4;
				
				}
			$transaction = Yii::app()->db->beginTransaction();
		try{
			$model->class_message_examine = $examine;
			$model->save();
			
			$checkReply = ClassMessageReply::model()->find("class_message_id=:class_message_id",array("class_message_id"=>$_GET['id']));
			if($checkReply){
				
				$checkReply->class_message_reply_content = $reply;
				$checkReply->class_message_reply_time = date("Y-m-d H:i:s");
				$checkReply->class_message_id = $_GET['id'];
				$checkReply->admin_id = Yii::app()->user->id;
				if($checkReply->save(false)){
				
					/*写回复留言日志*/
					$log = new LogInfo();
					$log->admin_id = Yii::app()->user->id;
					$log->log_content = AdminInfo::model()->findByPk(Yii::app()->user->id)->admin_name."回复留言".$model->class_message_id."成功！";
					$log->log_title = "ReplyMember";
					$log->log_time = date("Y-m-d H:i:s");
					$log->save(false);
					echo "<script type='text/javascript'>alert('操作成功')</script>";
					echo "<script type='text/javascript'>location.href='index.php?r=message/view&id='".$_GET['id']."</script>";
				
				}
				
			}else{
			
				$Replymodel=new ClassMessageReply();
				$Replymodel->admin_id = Yii::app()->user->id;
				$Replymodel->class_message_id = $_GET['id'];
				$Replymodel->class_message_reply_content = $reply;
				$Replymodel->class_message_reply_time = date("Y-m-d H:i:s");
				if($Replymodel->save(false) && $model->save(false)){
					/*写回复留言日志*/
					$log = new LogInfo();
					$log->admin_id = Yii::app()->user->id;
					$log->log_content = AdminInfo::model()->findByPk(Yii::app()->user->id)->admin_name."回复留言".$model->class_message_id."成功！";
					$log->log_title = "ReplyMember";
					$log->log_time = date("Y-m-d H:i:s");
					$log->save(false);
				
					echo "<script type='text/javascript'>alert('操作成功')</script>";
					echo "<script type='text/javascript'>location.href='index.php?r=message/view&id='".$_GET['id']."</script>";
				
				
				}
			}
			$transaction->commit();//事务提交
		}catch (Exception $e){
			$transaction->rollback;//事务回滚
			throw new Exception("系统错误");
		
		}
		}
		
		$this->render('view',array('model'=>$model));
	}

	
}
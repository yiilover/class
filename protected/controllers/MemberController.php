<?php

class MemberController extends Controller
{
	//首页，查看系所有学生
	public function actionIndex()
	{
		$model = new UserInfo('search');
		$model->unsetAttributes();  // clear any default values
		
		if(isset($_GET['UserInfo']))
			$model->attributes=$_GET['UserInfo'];
		$this->render('index',array('model'=>$model));
	}
	
	//添加班级成员
	public function actionAddMember(){
	
		
		
		$model = new UserInfo();
		if(isset($_POST['UserInfo'])){
			$userName = $_POST['UserInfo']['user_name'];
			$userClass = $_POST['UserInfo']['user_class_id'];
			$checkModel = UserInfo::model()->find('user_name=:user_name and user_class_id=:user_class_id',array("user_name"=>$userName,"user_class_id"=>$userClass));
			if($checkModel){
			
					echo "<script type='text/javascript'>alert('该学生已存在！')</script>";
				
			}else{
				
					$model->attributes=$_POST['UserInfo'];
					$model->user_is_manager = 0;
	
					if($model->save(false)){
						
						/*写添加班级成员日志*/
						$log = new LogInfo();
						$log->admin_id = Yii::app()->user->id;
						$log->log_content = AdminInfo::model()->findByPk(Yii::app()->user->id)->admin_name."添加成员".$model->user_name."成功！";
						$log->log_title = "AddMember";
						$log->log_time = date("Y-m-d H:i:s");
						$log->save(false);
								
						if($this->ExcuteImage($model)){
							
							echo "<script type='text/javascript'>alert('添加成功！')</script>";
							echo "<script type='text/javascript'>location.href='index.php?r=member/view&id=".$model->user_id."'</script>";
						
						}else{
						
							echo "<script type='text/javascript'>alert('照片未添加成功,请稍后在修改学生信息中重新上传！')</script>";
							echo "<script type='text/javascript'>location.href='index.php?r=member/view&id=".$model->user_id."'</script>";
						}
					}
			}	
		}
		$this->render('add',array('model'=>$model));
	
	}
	
	
	//处理图片函数
	private function ExcuteImage($model)
	{	

		
		$model->user_photo=CUploadedFile::getInstance($model,'user_photo');
		
        if(isset($model->user_photo))
        {
        	$filename = date('YmdHms'.time());
			$sufix ='.jpg';
        	$imgtype = $model->user_photo->type;
        	switch($imgtype)
        	{
        		case 'image/gif':
        			$sufix ='.gif';
        			break;
        		case 'image/png':
        			$sufix ='.png';
        			break;
        	}

        	$model->user_photo->saveAs('photo/original/'.$filename.$sufix);
        	
			$image = Yii::app()->image->load('photo/original/'.$filename.$sufix);
			$image->resize(140, 150);
			$image->save('photo/small/'.$filename.$sufix);
			$smallimg = 'photo/small/'.$filename.$sufix;
			
			$bool = UserInfo::model()->updateByPk($model->user_id,array('user_photo'=>$smallimg));
			if($bool){
			
				return true;
			
			
			}else{
			
				return false;
			
			}
        }

	}
	
	//查看班级成员详细信息
	
	public function actionView(){
	
	
		$model = UserInfo::model()->findByPk($_GET['id']);
	
		$this->render('view',array('model'=>$model));
	
	
	
	}
	//更新班级成员信息
	public function actionUpdate(){
	
	
		$model= UserInfo::model()->findByPk($_GET['id']);
		if(isset($_POST['UserInfo'])){
			
			$photo = $model->user_photo;
			if($_POST['UserInfo']['user_photo']==''){
			
				$_POST['UserInfo']['user_photo']=$photo;
			
			}
			$model->attributes=$_POST['UserInfo'];
			$model->user_is_manager = 0;
			
			if($model->save(false)){
				/*写修改班级成员信息日志*/
				$log = new LogInfo();
				$log->admin_id = Yii::app()->user->id;
				$log->log_content = AdminInfo::model()->findByPk(Yii::app()->user->id)->admin_name."修改".$model->user_name."信息成功！";
				$log->log_title = "UpdateMember";
				$log->log_time = date("Y-m-d H:i:s");
				$log->save(false);
						
						if($this->ExcuteImage($model)){
							
							
							echo "<script type='text/javascript'>location.href='index.php?r=member/view&id=".$model->user_id."'</script>";
						
						}
						
						else{
							
							echo "<script type='text/javascript'>alert('修改成功！')</script>";
							echo "<script type='text/javascript'>location.href='index.php?r=member/view&id=".$model->user_id."'</script>";
						}
						
					}else{
					
					
							echo "<script type='text/javascript'>alert('修改失败！')</script>";
							echo "<script type='text/javascript'>location.href='index.php?r=member/view&id=".$model->user_id."'</script>";
					
					
					}
		
		}
		
		$this->render('update',array('model'=>$model));
	
	
	
	}
	
	//删除班级成员
	public function actionDelete(){
	
	
	
		$model = UserInfo::model()->findByPk($_GET['id']);
		$model->delete();
		/*写删除班级成员日志*/
				$log = new LogInfo();
				$log->admin_id = Yii::app()->user->id;
				$log->log_content = AdminInfo::model()->findByPk(Yii::app()->user->id)->admin_name."删除".$model->user_name."成功！";
				$log->log_title = "DeleteMember";
				$log->log_time = date("Y-m-d H:i:s");
				$log->save(false);
	
	
	
	}

}
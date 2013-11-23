<?php 
	$css=Yii::app()->clientScript;
	$css->registerCssFile(Yii::app()->baseUrl . '/css/viewMessage.css');
	?>


<div id="all">
	<div class="info">
		<div id="title"><?php echo $model->class_notice_type == 0 ? "系统公告":"班级通知"?></div>
		<div class="some">
			<span id="class"><font color="red">To : </font><?php echo $model->class->class_name;?>　|　</span>
			<span id="author"><font color="red">From : </font><?php echo $model->admin->admin_name;?>　|　</span>
			<span id="time"><?php echo $model->class_notice_time;?>　|　</span>
		</div>
		</div>
		<div id="content"><?php echo $model->class_notice_content?></div>
	
</div>

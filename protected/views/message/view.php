<?php

$this->breadcrumbs=array(
	"留言管理"=>array("index"),
	"查看详细信息"
);
	$css=Yii::app()->clientScript;
	$css->registerCssFile(Yii::app()->baseUrl . '/css/viewMessage.css');
?>

<div id="all">
	<div class="info">
		<div id="title"><?php echo $model->class_message_title;?></div>
		<div class="some">
			<span id="class"><?php echo $model->class->class_name;?>　|　</span>
			<span id="author"><?php echo $model->class_message_comefrom;?>　|　</span>
			<span id="time"><?php echo $model->class_message_time;?>　|　</span>
			<span id="status"><?php echo help::aa($model->class_message_examine)?></span>
		</div>
	</div>
	<div id="content">内容<?php echo $model->class_message_content;?></div>
	<div id="reply">
		<i><span id="red">回复 : </span></i>
		<?php if($model->message){echo $model->message->class_message_reply_content;}else{echo "无";}?>
		<div class="some" id="reply_some">
				<span><?php if($model->message) echo AdminInfo::model()->findByPk($model->message->admin_id)->admin_name;?></span>
				<span><?php if($model->message){echo "回复于".$model->message->class_message_reply_time;}?></span>
			</div>
		</div>
	
</div>
<div id="form">
	
	<form name="form" action="index.php?r=message/view&id=<?php echo $model->class_message_id;?>" method="post">
	<div id="examine">
		<label id="examine_label">审核:</label>
		<select id="examine_select" name="examine">
			<option value='2'>审核通过</option>
			<option value='1'>审核中</option>
			<option value='3'>审核不通过</option>
			</select>
	</div><div id="reply_form">
			<label id="reply_label">回复:</label>
			<TEXTAREA id="reply_text" name="text">无</TEXTAREA>
	</div>
	<div id=submit>
		<input type="submit" name="sub" value="提交" id="sub">
		<a href="index.php?r=message/index"><button id="button">返回留言列表</button></a>	
		</div>
	
	</form>

</div>



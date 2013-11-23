<?php
	$this->breadcrumbs=array(
		"班级成员管理"=>array("index"),
		"查看详细信息"
	);
	
	$css=Yii::app()->clientScript;
	$css->registerCssFile(Yii::app()->baseUrl . '/css/viewMember.css');
?>
<table id="TbviewMember">
	<caption id="caption">学生详细信息表</caption>
	<tr>
		<td colspan="2" class="span">姓名:<span id="username" class="attributs"><?php echo $model->user_name;?></span></td>
		<td rowspan="4" id="photo"><?php echo CHtml::image($model->user_photo,'',array('style'=>'padding:5px 0px 0px 5px;'));?></td>
		
	</tr>
	
	<tr>
		
		<td class="span">性别:<span class="attributs"><?php echo $model->user_sex==0?'男':'女';?></span></td>
		<td class="span">年龄:<span class="attributs"><?php echo $model->user_age;?></span></td>
		
	</tr>
	<tr>
		
		<td class="span">电话:<span class="attributs"><?php echo $model->user_phone;?></span></td>
		<td class="span">Email:<span class="attributs"><?php echo $model->user_email;?></span></td>
		
	</tr>
	<tr>
		
		<td class="span">民族:<span class="attributs"><?php echo $model->user_nation;?></span></td>
		<td class="span">籍贯:<span class="attributs"><?php echo $model->user_native;?></span></td>
		
	</tr>
	<tr>
		<td colspan="3" class="span">班级:<span class="attributs">
			<?php 
				$class = ClassInfo::model()->findByPk($model->user_class_id);
				echo $class->class_name;
			?>
		</span></td>
	</tr>
	<tr><td colspan="3" class="span">住址:<span class="attributs"><?php echo $model->user_address;?></span></td></tr>
	<tr><td colspan="3" id="remark" class="span">备注:<span id="remark_span" class="attributs"><?php echo $model->user_remark;?></span></td></tr>

</table>
<div><button id="update"><a href="index.php?r=member/update&id=<?php echo $model->user_id?>">修改</a></button></div>

<?php

$this->breadcrumbs=array(
	"班级成员管理"=>array("index"),
	"新增班级成员"
);

$form=$this->beginWidget('CActiveForm', array(
		'id'=>'add_member',
		'enableClientValidation'=>true,
		//'enableAjaxValidation'=>true,
		'clientOptions'=>array(
			'validateOnSubmit'=>true,
		),
		'method'=>'POST',
		'action'=>"index.php?r=member/addMember",
		'htmlOptions' =>array('enctype' =>'multipart/form-data'),
	)); 
?>
<div>
			<?php echo $form->errorSummary($model); ?>
</div>
<div>
			<?php
					
					echo $form->labelEx($model,'班级');
					$AdminInfomodel = AdminInfo::model()->findByPk(Yii::app()->user->id);
					$class = ClassInfo::model()->findAll('college_id=:college_id',array('college_id'=>$AdminInfomodel->college_id));
					$listdata = CHtml::listData($class,'class_id','class_name');
					echo $form->dropDownList($model,'user_class_id',$listdata); 
					
			?>


</div>	
<div>
			<?php echo $form->labelEx($model,'姓名'); ?>
			<?php echo $form->textField($model,'user_name'); ?>
			<?php echo $form->error($model,'user_name'); ?>
</div>
<div>
			<?php echo $form->labelEx($model,'性别'); ?>
			<?php echo $form->dropDownList($model,'user_sex',array('0'=>'男','1'=>'女'));?>
			
</div>
<div>		
			<?php echo $form->labelEx($model,'年龄'); ?>
			<?php echo $form->textField($model,'user_age'); ?>
			<?php echo $form->error($model,'user_age'); ?>
</div>
<div>		
			<?php echo $form->labelEx($model,'民族'); ?>
			<?php echo $form->textField($model,'user_nation'); ?>
			<?php echo $form->error($model,'user_nation'); ?>
</div>
<div>		
			<?php echo $form->labelEx($model,'籍贯'); ?>
			<?php echo $form->textField($model,'user_native'); ?>
			<?php echo $form->error($model,'user_native'); ?>
</div>
<div>		
			<?php echo $form->labelEx($model,'电话'); ?>
			<?php echo $form->textField($model,'user_phone'); ?>
			<?php echo $form->error($model,'user_phone'); ?>
</div>
<div>		
			<?php echo $form->labelEx($model,'邮箱'); ?>
			<?php echo $form->textField($model,'user_email'); ?>
			<?php echo $form->error($model,'user_email'); ?>
</div>
<div>		
			<?php echo $form->labelEx($model,'住址'); ?>
			<?php echo $form->textArea($model,'user_address'); ?>
			<?php echo $form->error($model,'user_address'); ?>
</div>
<div>		
			<?php echo $form->labelEx($model,'备注'); ?>
			<?php echo $form->textArea($model,'user_remark'); ?>
			<?php echo $form->error($model,'user_remark'); ?>
</div>
<div>
			<label>照片</label>
			<?php echo CHtml::activeFileField($model,'user_photo'); ?>
			<?php echo $form->error($model,'user_photo'); ?>
</div>
<div>
			<?php echo CHtml::submitButton('新增'); ?>

</div>
<?php $this->endWidget()?>



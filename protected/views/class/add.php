<?php
$this->breadcrumbs=array(
	"班级管理"=>array("index"),
	"新增班级"
);

$form=$this->beginWidget('CActiveForm', array(
		'id'=>'add_class',
		'enableClientValidation'=>true,
		//'enableAjaxValidation'=>true,
		'clientOptions'=>array(
			'validateOnSubmit'=>true,
		),
		'method'=>'POST',
		'action'=>"index.php?r=class/addClass"
	)); ?>
	
<div>
			<?php echo $form->errorSummary($model); ?>
</div>
<div>
			<?php
					
					echo $form->labelEx($model,'　　 级别');
					$LocalDate=getdate();
					$LocalYear = $LocalDate['year'];
					$gradeArr = array($LocalYear,$LocalYear-1,$LocalYear-2,$LocalYear-3,$LocalYear-4);
					echo $form->dropDownList($model,'class_grade',$gradeArr); 
			?>


</div>	
<div>
			<?php echo $form->labelEx($model,'　班级名'); ?>
			<?php echo $form->textField($model,'class_name'); ?>
			<?php echo $form->error($model,'class_name'); ?>
</div>
<div>		
			<?php echo $form->labelEx($model,'班级人数'); ?>
			<?php echo $form->textField($model,'class_size'); ?>
			<?php echo $form->error($model,'class_size'); ?>
</div>
<div>
			<?php echo CHtml::submitButton('新增'); ?>

</div>
<?php $this->endWidget()?>
<?php
$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);

	$css=Yii::app()->clientScript;
	$css->registerCssFile(Yii::app()->baseUrl . '/css/viewMember.css');
?>

<h1>登录</h1>

<div class="form login">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>


<div class="row">
		<?php echo $form->labelEx($model,'college_id');
		$collegedata = Yii::app()->db->createCommand()
				    ->select()
				    ->from('college')
				    ->queryAll();
				    
				    $listdata = CHtml::listData($collegedata,'college_id','college_name');

		echo $form->dropDownList($model,'college_id',$listdata); 
		echo $form->error($model,'college_id'); ?>
	</div>

<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username'); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password'); ?>
		<?php echo $form->error($model,'password'); ?>

	</div>

	<div class="row rememberMe">
		<?php echo $form->checkBox($model,'rememberMe'); ?>
		<?php echo $form->label($model,'rememberMe'); ?>
		<?php echo $form->error($model,'rememberMe'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('登录'); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->

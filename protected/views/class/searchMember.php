
<div id="search">
	<h3>搜索学生</h3>
<?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'search_member',
        'method'=>'get',
        'enableClientValidation'=>true,
        'clientOptions'=>array(
			'validateOnSubmit'=>true,
		),
    )); ?>
	    <span class="long">
	       		<label>姓名:</label>
	
	       		<?php echo $form->textField($model,'user_name'); ?>
	    </span>
    	<span class="long">
	       		<label>学号:</label>
	
	       		<?php echo $form->textField($model,'user_number'); ?>
	   </span>
	   <span class="long">
       		<label>班级:</label>
       		<?php echo $form->textField($model,'user_class_id'); ?>
       		
       </span>
       <span class="long">
       		<label>性别:</label>
       		<?php echo $form->textField($model,'user_sex'); ?>
       </span>
       
       
       <div class="btn"><?php echo CHtml::submitButton('搜索')?></div>
    
    <?php $this->endWidget();?>

</div>
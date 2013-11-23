
<div id="search">
	<h3>搜索班级</h3>
<?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'search_class',
        'method'=>'get',
        'enableClientValidation'=>true,
        'clientOptions'=>array(
			'validateOnSubmit'=>true,
		),
    )); ?>
	    <span class="long">
	       		<label>级别:</label>
	
	       		<?php echo $form->textField($model,'class_grade'); ?>
	    </span>
     
       <span class="long">
       		<label>班级名:</label>
       		<?php echo $form->textField($model,'class_name'); ?>
       </span>
       <span class="long">
       		<label>班级ID:</label>

       		<?php echo $form->textField($model,'class_id'); ?>
       </span>
       <div class="btn"><?php echo CHtml::submitButton('搜索')?></div>
    
    <?php $this->endWidget();?>

</div>
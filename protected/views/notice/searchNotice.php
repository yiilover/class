<div id="search">
	<h3>搜索通知</h3>

<?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'search_notice',
        'method'=>'get',
        'enableClientValidation'=>true,
        'clientOptions'=>array(
			'validateOnSubmit'=>true,
		),
    )); ?>
	    <span class="long">
	       		<label>类型:</label>
				<?php $list = array('0'=>"系统公告","1"=>"班级通知")?>
	       		<?php echo $form->dropDownList($model,'class_notice_type',$list); ?>
	    </span>
	    <div class="btn"><?php echo CHtml::submitButton('搜索')?></div>
	    <?php $this->endWidget();?>
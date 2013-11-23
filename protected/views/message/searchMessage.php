<div id="search">
	<h3>搜索留言</h3>

<?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'search_member',
        'method'=>'get',
        'enableClientValidation'=>true,
        'clientOptions'=>array(
			'validateOnSubmit'=>true,
		),
    )); ?>
	    <span class="long">
	       		<label>状态:</label>
				<?php $list = array('0'=>"未审核","1"=>"审核中","2"=>"审核通过","3"=>"审核未通过","4"=>"已回复")?>
	       		<?php echo $form->dropDownList($model,'class_message_examine',$list); ?>
	    </span>
	    <div class="btn"><?php echo CHtml::submitButton('搜索')?></div>
	    <?php $this->endWidget();?>
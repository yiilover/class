<?php
$this->breadcrumbs=array(
	"公告管理"=>array("index"),
	"新增公告"
);

$form=$this->beginWidget('CActiveForm', array(
		'id'=>'add_notice',
		'enableClientValidation'=>true,
		//'enableAjaxValidation'=>true,
		'clientOptions'=>array(
			'validateOnSubmit'=>true,
		),
		'method'=>'POST',
		'action'=>"index.php?r=notice/add"
	)); ?>
	
<div>
			<?php echo $form->errorSummary($model); ?>
</div>

<div>
			<?php
					
					echo $form->labelEx($model,'所属班级');
					$AdminInfomodel = AdminInfo::model()->findByPk(Yii::app()->user->id);
					$class = ClassInfo::model()->findAll('college_id=:college_id',array('college_id'=>$AdminInfomodel->college_id));
					$listdata = CHtml::listData($class,'class_id','class_name');
					echo $form->dropDownList($model,'class_id',$listdata); 
					
			?>
</div>

<div>
			<?php
					
					echo $form->labelEx($model,'通知类型');
					$gradeArr = array("0"=>"系统公告","1"=>"班级通知");
					echo $form->dropDownList($model,'class_notice_type',$gradeArr); 
			?>


</div>	

<div>		
			<?php echo $form->labelEx($model,'通知内容',array("style"=>"display:block")); ?>
			<?php
				$this->widget('application.extensions.fckeditor.FCKEditorWidget',array(
				'model'     =>  $model,
				'attribute' => 'class_notice_content',//属性的名字
				'height'    =>  '500px',//高度
				'width'     =>  '100%',//宽度
				'fckeditor' =>  Yii::app()->basePath.'/../fckeditor/fckeditor.php',
				'fckBasePath' => Yii::app()->baseUrl.'/fckeditor/',
				'config' => array('ToolbarStartExpanded'=>True),//配置，这里设置的是默认不展开工具条
				//'editorTemplate' => 'full'
				)
				); 
			?>
</div>
<div>
			<?php echo CHtml::submitButton('新增'); ?>

</div>
<?php $this->endWidget()?>
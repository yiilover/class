<?php
$this->breadcrumbs=array(
	'公告管理',
);?>
<?php 

	$this->renderPartial('searchNotice',array('model'=>$model));
			$this->widget('zii.widgets.grid.CGridView', array(
			'id'=>'notice',
			'dataProvider'=>$model->search(),
			'columns'=>array(
		        array(
		        	'name'=>"ID",
		        	'value'=>'$data->class_notice_id',
		        ),
		        
		         array(
		        	'name'=>'内容',
		        	'value'=>'help::subString($data->class_notice_content)',
		        ),
		     	array(
		        	'name'=>'班级',
		        	'value'=>'$data->class->class_name',
		        ),
		        array(
		        	'name'=>'时间',
		        	'value'=>'$data->class_notice_time',
		        ),
		        
		        array(
		        	'name'=>'类型',
		        	'value'=>'$data->class_notice_type == 0?"系统公告":"班级通知"',
		        ),
	            array(// display a column with "view", "update" and "delete" buttons
		            'class'=>'CButtonColumn',
		        	'header'=>'操作',
	            	'template' => '{add}<br />{view}{update}{delete}',
		        	'buttons' => array(
		                'add'=> array(
		                    'url' => 'Yii::app()->controller->createUrl("notice/add")',
		        			'imageUrl'=>Yii::app()->baseUrl.'/assets/80089fe4/gridview/add.png',
		        			'options'=>array('title'=>'新增')
		                ),
		   ))    	
			
		)));
?>


<div><a href="index.php?r=notice/add">

<button>新增公告</button>

</a></div>
<?php
	$this->breadcrumbs=array(
		'留言管理',
	);
		//$content = iconv_substr($data->class_message_content,0,10,'UTF8');
		$this->renderPartial('searchMessage',array('model'=>$model));
		$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'message',
		'dataProvider'=>$model->search(),
		'columns'=>array(
	        array(
	        	'name'=>"ID",
	        	'value'=>'$data->class_message_id',
	        ),
	        
	         array(
	        	'name'=>'留言者姓名',
	        	'value'=>'$data->class_message_comefrom',
	        ),
	      
	        array(
	        	'name'=>'标题',
	        	'value'=>'$data->class_message_title',
	        ),
	        
	        array(
	        	'name'=>'内容',
	        	'value'=>'iconv_substr($data->class_message_content,0,10,"UTF-8")."......"',
	        ),
	         array(
	        	'name'=>'时间',
	        	'value'=>'iconv_substr($data->class_message_time,0,10,"UTF-8")',
	        ),
	        array(
	        	'name'=>'班级',
	        	'value'=>'$data->class->class_name',
	        ),
	        
	         array(
	        	'name'=>'状态',
	        	'type'=>'raw',
	        	'value'=>'help::aa($data->class_message_examine)',
				
	         ),
	      
	        array(// display a column with "view", "update" and "delete" buttons
	            'class'=>'CButtonColumn',
	        	'header'=>'操作',
	            'template' => '{view}'
	        )       	
		
	)));
?>

<?php

	$this->breadcrumbs=array(
		'班级成员管理',
	);
	$this->renderPartial('searchMember',array('model'=>$model));
	$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'member',
	'dataProvider'=>$data,
	'columns'=>array(
        array(
        	'name'=>"ID",
        	'value'=>'$data->user_id',
        ),
        
         array(
        	'name'=>'姓名',
        	'value'=>'$data->user_name',
        ),
     	array(
        	'name'=>'学号',
        	'value'=>'$data->user_number',
        ),
        array(
        	'name'=>'性别',
        	'value'=>'$data->user_sex==0?"男":"女"',
        ),
        
        array(
        	'name'=>'年龄',
        	'value'=>'$data->user_age',
        ),
         array(
        	'name'=>'班级',
        	'value'=>'$data->class->class_name',
        ),
        array(
        	'name'=>'Email',
        	'value'=>'$data->user_email',
        ),
        array(
        	'name'=>'Phone',
        	'value'=>'$data->user_phone',
        ),
        array(// display a column with "view", "update" and "delete" buttons
            'class'=>'CButtonColumn',
        	'header'=>'操作',
            'template' => '{add}<br />{view}{update}{delete}',
        	'buttons' => array(
                'add'=> array(
                    'url' => 'Yii::app()->controller->createUrl("member/addMember")',
        			'imageUrl'=>Yii::app()->baseUrl.'/assets/80089fe4/gridview/add.png',
        			'options'=>array('title'=>'新增')
                ),
                'update'=>array(
                
                	'url' => 'help::urlHelper("member/update","id",$data->user_id)',
                
                ),
                'view'=>array(
                
                	'url' => 'help::urlHelper("member/view","id",$data->user_id)',
              
                ),
                'delete'=>array(
                
                	'url' => 'help::urlHelper("member/delete","id",$data->user_id)',
                
                ),
        
        
        )       	
        ),
        
	
	
)));
?>


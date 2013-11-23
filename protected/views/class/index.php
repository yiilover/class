
<?php 
$this->breadcrumbs=array(
	"班级管理"
);

	$this->renderPartial('searchClass',array('model'=>$model));
?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'class',
	'dataProvider'=>$model->search(),
	'columns'=>array(
        array(
        	'name'=>"班级ID",
        	'value'=>'$data->class_id',
			'htmlOptions'=>array('class'=>'id')
        ),
        
         array(
        	'name'=>'级别',
        	'value'=>'$data->class_grade',
			'htmlOptions'=>array('class'=>'size')
        ),
      
        array(
        	'name'=>'班级名',
        	'value'=>'$data->class_name',
			'htmlOptions'=>array('class'=>'name')
        ),
        array(
        	'name'=>'班级人数',
        	'value'=>'$data->class_size',
			'htmlOptions'=>array('class'=>'size')
        ),
        array(// display a column with "view", "update" and "delete" buttons
            'class'=>'CButtonColumn',
        	'header'=>'操作',
        	'template' => '{add}<br />{view}{update}{delete}',
        	'buttons' => array(
                'add'=> array(
                    'url' => 'Yii::app()->controller->createUrl("class/addClass")',
        			'imageUrl'=>Yii::app()->baseUrl.'/assets/80089fe4/gridview/add.png',
        			'options'=>array('title'=>'新增')
                ),
        ),
        
	),
	
)));
?>
<div><a href="index.php?r=class/addClass"><button>新增班级</button></a></div>


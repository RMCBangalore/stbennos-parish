<?php
/* @var $this AwarenessDataController */
/* @var $model AwarenessData */

$this->breadcrumbs=array(
	'Awareness Datas'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List AwarenessData', 'url'=>array('index')),
	array('label'=>'Create AwarenessData', 'url'=>array('create')),
	array('label'=>'Update AwarenessData', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete AwarenessData', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage AwarenessData', 'url'=>array('admin')),
);
?>

<h1>View AwarenessData #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'family_id',
		'id',
		'aware',
		'accessed',
	),
)); ?>

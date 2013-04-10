<?php
/* @var $this FirstCommunionRecordsController */
/* @var $model FirstCommunionRecord */

$this->breadcrumbs=array(
	'First Communion Records'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List FirstCommunionRecord', 'url'=>array('index')),
	array('label'=>'Create FirstCommunionRecord', 'url'=>array('create')),
	array('label'=>'Update FirstCommunionRecord', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete FirstCommunionRecord', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage FirstCommunionRecord', 'url'=>array('admin')),
);
?>

<h1>View FirstCommunionRecord #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'church',
		'communion_dt',
	),
)); ?>

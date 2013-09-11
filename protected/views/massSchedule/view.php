<?php
/* @var $this MassScheduleController */
/* @var $model MassSchedule */

$this->breadcrumbs=array(
	'Admin' => array('site/page', 'view' => 'admin'),
	'Mass Schedules'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List MassSchedule', 'url'=>array('index')),
	array('label'=>'Create MassSchedule', 'url'=>array('create')),
	array('label'=>'Update MassSchedule', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete MassSchedule', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage MassSchedule', 'url'=>array('admin')),
);
?>

<h1>View MassSchedule #<?php echo $model->id; ?></h1>

<?php 
$model->time = date_format(new DateTime($model->time), 'g:i a');
$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'time',
		'language',
		'day',
	),
)); ?>

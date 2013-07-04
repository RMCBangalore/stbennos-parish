<?php
/* @var $this MassScheduleController */
/* @var $model MassSchedule */

$this->breadcrumbs=array(
	'Mass Schedules'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List MassSchedule', 'url'=>array('index')),
	array('label'=>'Manage MassSchedule', 'url'=>array('admin')),
);
?>

<h1>Create MassSchedule</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
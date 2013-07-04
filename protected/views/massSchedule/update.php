<?php
/* @var $this MassScheduleController */
/* @var $model MassSchedule */

$this->breadcrumbs=array(
	'Mass Schedules'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List MassSchedule', 'url'=>array('index')),
	array('label'=>'Create MassSchedule', 'url'=>array('create')),
	array('label'=>'View MassSchedule', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage MassSchedule', 'url'=>array('admin')),
);
?>

<h1>Update MassSchedule <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
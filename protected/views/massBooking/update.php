<?php
/* @var $this MassBookingController */
/* @var $model MassBooking */

$this->breadcrumbs=array(
	'Mass Bookings'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List MassBooking', 'url'=>array('index')),
	array('label'=>'Create MassBooking', 'url'=>array('create')),
	array('label'=>'View MassBooking', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage MassBooking', 'url'=>array('admin')),
);
?>

<h1>Update MassBooking <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'mass_id' => $model->mass_id, 'mass_dt' => $model->mass_dt)); ?>

<?php
/* @var $this MassBookingController */
/* @var $model MassBooking */

$this->breadcrumbs=array(
	'Mass Bookings'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List MassBooking', 'url'=>array('index')),
	array('label'=>'Manage MassBooking', 'url'=>array('admin')),
);
?>

<h1>Create MassBooking</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
<?php
/* @var $this MassBookingController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Mass Bookings',
);

$this->menu=array(
	array('label'=>'Create Mass Booking', 'url'=>array('create')),
	array('label'=>'Manage Mass Bookings', 'url'=>array('admin')),
	array('label'=>'Mass Booking Calendar', 'url'=>array('calendar')),
);
?>

<h1>Mass Bookings</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

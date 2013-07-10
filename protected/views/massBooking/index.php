<?php
/* @var $this MassBookingController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Mass Bookings',
);

$this->menu=array(
	array('label'=>'Create MassBooking', 'url'=>array('create')),
	array('label'=>'Manage MassBooking', 'url'=>array('admin')),
);
?>

<h1>Mass Bookings</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

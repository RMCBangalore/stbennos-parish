<?php
/* @var $this BaptismRecordsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Registers' => array('site/page', 'view' => 'registers'),
	'Baptism Records',
);

$this->menu=array(
	array('label'=>'Create BaptismRecord', 'url'=>array('create')),
	array('label'=>'Manage BaptismRecord', 'url'=>array('admin')),
);
?>

<h1>Baptism Records</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

<?php
/* @var $this FirstCommunionRecordsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
       'Registers' => array('site/page', 'view' => 'registers'),
	'First Communion Records',
);

$this->menu=array(
	array('label'=>'Create FirstCommunionRecord', 'url'=>array('create')),
	array('label'=>'Manage FirstCommunionRecord', 'url'=>array('admin')),
);
?>

<h1>First Communion Records</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

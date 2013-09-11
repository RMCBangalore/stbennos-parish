<?php
/* @var $this MarriageRecordsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
       'Registers' => array('site/page', 'view' => 'registers'),
	'Marriage Records',
);

$this->menu=array(
	array('label'=>'Create MarriageRecord', 'url'=>array('create')),
	array('label'=>'Manage MarriageRecord', 'url'=>array('admin')),
);
?>

<h1>Marriage Records</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

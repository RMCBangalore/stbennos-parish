<?php
/* @var $this ConfirmationRecordsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Confirmation Records',
);

$this->menu=array(
	array('label'=>'Create ConfirmationRecord', 'url'=>array('create')),
	array('label'=>'Manage ConfirmationRecord', 'url'=>array('admin')),
);
?>

<h1>Confirmation Records</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

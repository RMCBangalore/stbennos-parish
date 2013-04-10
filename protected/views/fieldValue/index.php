<?php
/* @var $this FieldValueController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Field Values',
);

$this->menu=array(
	array('label'=>'Create FieldValues', 'url'=>array('create')),
	array('label'=>'Manage FieldValues', 'url'=>array('admin')),
);
?>

<h1>Field Values</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

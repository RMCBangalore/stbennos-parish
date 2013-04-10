<?php
/* @var $this FieldNameController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Field Names',
);

$this->menu=array(
	array('label'=>'Create FieldNames', 'url'=>array('create')),
	array('label'=>'Manage FieldNames', 'url'=>array('admin')),
);
?>

<h1>Field Names</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

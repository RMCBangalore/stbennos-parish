<?php
/* @var $this FieldNameController */
/* @var $model FieldNames */

$this->breadcrumbs=array(
	'Field Names'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List FieldNames', 'url'=>array('index')),
	array('label'=>'Create FieldNames', 'url'=>array('create')),
	array('label'=>'Update FieldNames', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete FieldNames', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage FieldNames', 'url'=>array('admin')),
);
?>

<h1>View FieldNames #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
	),
)); ?>

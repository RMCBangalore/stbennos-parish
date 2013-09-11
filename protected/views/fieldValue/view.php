<?php
/* @var $this FieldValueController */
/* @var $model FieldValues */

$lbl = $_GET['type'] ? ucwords(implode(' ', explode('_', $_GET['type']))) : 'Field Values';

$lbls = preg_match('/s$/', $lbl) ? $lbl : "${lbl}s";

$this->breadcrumbs=array(
	'Admin' => array('site/page', 'view' => 'admin'),
	$lbls=>array('index', 'type' => $_GET['type']),
	$model->name,
);

if (isset($_GET['type'])) {
	$type = $_GET['type'];
} else {
	$type = $model->field->name;
}

$this->menu=array(
	array('label'=>'List FieldValues', 'url'=>array('index', 'type' => $type)),
	array('label'=>'Create FieldValues', 'url'=>array('create', 'type' => $type)),
	array('label'=>'Update FieldValues', 'url'=>array('update', 'id'=>$model->id, 'type' => $type)),
	array('label'=>'Delete FieldValues', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage FieldValues', 'url'=>array('admin', 'type' => $type)),
);
?>

<h1>View FieldValues #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'field_id',
		'id',
		'name',
		'code',
		'pos',
	),
)); ?>

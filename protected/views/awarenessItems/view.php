<?php
/* @var $this AwarenessItemsController */
/* @var $model AwarenessItem */

$this->breadcrumbs=array(
	'Admin' => array('site/page', 'view' => 'admin'),
	'Awareness Items'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List AwarenessItem', 'url'=>array('index')),
	array('label'=>'Create AwarenessItem', 'url'=>array('create')),
	array('label'=>'Update AwarenessItem', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete AwarenessItem', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage AwarenessItem', 'url'=>array('admin')),
);
?>

<h1>View AwarenessItem #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'text',
	),
)); ?>

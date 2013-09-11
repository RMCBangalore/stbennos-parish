<?php
/* @var $this NeedItemsController */
/* @var $model NeedItem */

$this->breadcrumbs=array(
	'Admin' => array('site/page', 'view' => 'admin'),
	'Need Items'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List NeedItem', 'url'=>array('index')),
	array('label'=>'Create NeedItem', 'url'=>array('create')),
	array('label'=>'Update NeedItem', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete NeedItem', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage NeedItem', 'url'=>array('admin')),
);
?>

<h1>View NeedItem #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'text',
	),
)); ?>

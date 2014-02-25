<?php
/* @var $this CollectionController */
/* @var $model Transaction */

$this->breadcrumbs=array(
	'Collections'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Collection', 'url'=>array('index')),
	array('label'=>'Create Collection', 'url'=>array('create')),
);
?>

<h1>View Collection #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'type',
		'descr',
		'created',
		'creator',
		'amount',
	),
)); ?>


<?php
/* @var $this SatisfactionItemsController */
/* @var $model SatisfactionItem */

$this->breadcrumbs=array(
	'Satisfaction Items'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List SatisfactionItem', 'url'=>array('index')),
	array('label'=>'Create SatisfactionItem', 'url'=>array('create')),
	array('label'=>'Update SatisfactionItem', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete SatisfactionItem', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SatisfactionItem', 'url'=>array('admin')),
);
?>

<h1>View SatisfactionItem #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'text',
	),
)); ?>

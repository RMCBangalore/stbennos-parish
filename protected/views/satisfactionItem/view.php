<?php
/* @var $this SatisfactionItemController */
/* @var $model SatisfactionItems */

$this->breadcrumbs=array(
	'Satisfaction Items'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List SatisfactionItems', 'url'=>array('index')),
	array('label'=>'Create SatisfactionItems', 'url'=>array('create')),
	array('label'=>'Update SatisfactionItems', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete SatisfactionItems', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SatisfactionItems', 'url'=>array('admin')),
);
?>

<h1>View SatisfactionItems #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'text',
	),
)); ?>

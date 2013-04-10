<?php
/* @var $this SatisfactionDataController */
/* @var $model SatisfactionData */

$this->breadcrumbs=array(
	'Satisfaction Datas'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List SatisfactionData', 'url'=>array('index')),
	array('label'=>'Create SatisfactionData', 'url'=>array('create')),
	array('label'=>'Update SatisfactionData', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete SatisfactionData', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SatisfactionData', 'url'=>array('admin')),
);
?>

<h1>View SatisfactionData #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'family_id',
		'id',
		'satisfaction_item_id',
		'satisfaction_value',
	),
)); ?>

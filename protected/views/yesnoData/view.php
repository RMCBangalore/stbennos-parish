<?php
/* @var $this YesnoDataController */
/* @var $model YesnoData */

$this->breadcrumbs=array(
	'Yesno Datas'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List YesnoData', 'url'=>array('index')),
	array('label'=>'Create YesnoData', 'url'=>array('create')),
	array('label'=>'Update YesnoData', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete YesnoData', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage YesnoData', 'url'=>array('admin')),
);
?>

<h1>View YesnoData #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'family_id',
		'id',
		'question_id',
		'value',
	),
)); ?>

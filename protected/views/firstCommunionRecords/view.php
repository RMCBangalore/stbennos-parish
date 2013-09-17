<?php
/* @var $this FirstCommunionRecordsController */
/* @var $model FirstCommunionRecord */

$this->breadcrumbs=array(
       'Registers' => array('site/page', 'view' => 'registers'),
	'First Communion Records'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List First Communion Record', 'url'=>array('index')),
	array('label'=>'Create First Communion Record', 'url'=>array('create')),
	array('label'=>'Update First Communion Record', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete First Communion Record', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage First Communion Record', 'url'=>array('admin')),
	array('label'=>'View Certificates', 'url'=>array('/firstCommunionCertificate/byRecord', 'id'=>$model->id))
);
?>

<h1>View First Communion Record #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'communion_dt',
	),
)); ?>

<?php echo CHtml::link('Create Certificate', array('firstCommunionCertificate/create', 'id' => $model->id)) ?>


<?php
/* @var $this OpenDataController */
/* @var $model OpenData */

$this->breadcrumbs=array(
	'Open Datas'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List OpenData', 'url'=>array('index')),
	array('label'=>'Create OpenData', 'url'=>array('create')),
	array('label'=>'Update OpenData', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete OpenData', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage OpenData', 'url'=>array('admin')),
);
?>

<h1>View OpenData #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'family_id',
		'id',
		'question_id',
		'value',
	),
)); ?>

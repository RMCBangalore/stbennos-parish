<?php
/* @var $this YesnoQuestionController */
/* @var $model YesnoQuestions */

$this->breadcrumbs=array(
	'Yesno Questions'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List YesnoQuestions', 'url'=>array('index')),
	array('label'=>'Create YesnoQuestions', 'url'=>array('create')),
	array('label'=>'Update YesnoQuestions', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete YesnoQuestions', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage YesnoQuestions', 'url'=>array('admin')),
);
?>

<h1>View YesnoQuestions #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'text',
	),
)); ?>

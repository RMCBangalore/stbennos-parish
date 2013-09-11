<?php
/* @var $this OpenQuestionsController */
/* @var $model OpenQuestion */

$this->breadcrumbs=array(
	'Admin' => array('site/page', 'view' => 'admin'),
	'Open Questions'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List OpenQuestion', 'url'=>array('index')),
	array('label'=>'Create OpenQuestion', 'url'=>array('create')),
	array('label'=>'Update OpenQuestion', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete OpenQuestion', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage OpenQuestion', 'url'=>array('admin')),
);
?>

<h1>View OpenQuestion #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'text',
		'type',
		'seq',
	),
)); ?>

<?php
/* @var $this DeathRecordsController */
/* @var $model DeathRecord */

$this->breadcrumbs=array(
	'Death Records'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List DeathRecord', 'url'=>array('index')),
	array('label'=>'Create DeathRecord', 'url'=>array('create')),
	array('label'=>'Update DeathRecord', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete DeathRecord', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage DeathRecord', 'url'=>array('admin')),
);
?>

<h1>View DeathRecord #<?php echo $model->id . ': ' . $model->fname . ' ' . $model->lname; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'ref_no',
		'death_dt',
		'cause',
		'fname',
		'lname',
		'age',
//		'profession',
		'sacrament',
		'community',
		'residence',
		'parents_relatives',
		'buried_dt',
		'minister',
		'burial_place',
	),
)); ?>

<?php echo CHtml::link('Create Certificate', array('deathCertificate/create', 'id' => $model->id)) ?>


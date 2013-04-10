<?php
/* @var $this MarriageRecordsController */
/* @var $model MarriageRecord */

$this->breadcrumbs=array(
	'Marriage Records'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List MarriageRecord', 'url'=>array('index')),
	array('label'=>'Create MarriageRecord', 'url'=>array('create')),
	array('label'=>'Update MarriageRecord', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete MarriageRecord', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage MarriageRecord', 'url'=>array('admin')),
);
?>

<h1>View MarriageRecord #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'marriage_dt',
		'groom_name',
		'groom_dob',
		'groom_status',
		'groom_rank_prof',
		'groom_fathers_name',
		'groom_mothers_name',
		'groom_residence',
		'bride_name',
		'bride_dob',
		'bride_status',
		'bride_rank_prof',
		'bride_fathers_name',
		'bride_mothers_name',
		'bride_residence',
		'banns_licence',
		'minister',
		'witness1',
		'witness2',
		'remarks',
	),
)); ?>

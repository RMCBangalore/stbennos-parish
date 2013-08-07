<?php
/* @var $this ConfirmationRecordsController */
/* @var $model ConfirmationRecord */

$this->breadcrumbs=array(
	'Confirmation Records'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List ConfirmationRecord', 'url'=>array('index')),
	array('label'=>'Create ConfirmationRecord', 'url'=>array('create')),
	array('label'=>'Update ConfirmationRecord', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ConfirmationRecord', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ConfirmationRecord', 'url'=>array('admin')),
);
?>

<h1>View ConfirmationRecord #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'ref_no',
		'name',
		'confirmation_dt',
		'church',
		'dob',
		'baptism_dt',
		'baptism_place',
		'parents_name',
		'godparent_name',
		'residence',
		'minister',
	),
)); ?>

<?php echo CHtml::link('Create Certificate', array('confirmationCertificate/create', 'id' => $model->id)) ?>


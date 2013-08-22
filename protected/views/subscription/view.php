<?php
/* @var $this SubscriptionController */
/* @var $model Subscription */

$this->breadcrumbs=array(
	'Subscriptions'=>array('index'),
	$model->id,
);

if (!isset($family)) {
	$family = $model->family;
}

$this->menu=array(
	array('label'=>'List Subscription', 'url'=>array('index','fid'=>$family->id)),
	array('label'=>'Create Subscription', 'url'=>array('create','fid'=>$family->id)),
	array('label'=>'Update Subscription', 'url'=>array('update', 'id'=>$model->id,'fid'=>$family->id)),
	array('label'=>'Delete Subscription', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id,'fid'=>$family->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Subscription', 'url'=>array('admin')),
);
?>

<h1>View Subscription #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'family_id',
		'trans_id',
		'yr_month',
	),
)); ?>

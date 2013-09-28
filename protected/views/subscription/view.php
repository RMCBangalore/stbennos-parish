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
		array(
			'label' => 'Family&nbsp;(Head&nbsp;name,&nbsp;id)',
			'name' => 'family_id',
			'value' => $model->family->head_name ." #" . $model->family->id
		),
		array(
			'label' => 'From&nbsp;month',
			'name' => 'start_year',
			'value' => date_format(new DateTime(implode("-",array($model->start_year,$model->start_month,1))), "M, Y"),
		),
		array(
			'label' => 'Till&nbsp;month',
			'name' => 'end_year',
			'value' => date_format(new DateTime(implode("-",array($model->end_year,$model->end_month,1))), "M, Y"),
		),
		array(
			'label' => 'Monthly Amt &#8377;',
			'value' => $model->amount,
		),
		array(
			'label' => 'Total Amount &#8377;',
			'value' => $model->trans->amount,
		),
		'paid_by',
	),
)); ?>

<?php echo CHtml::link('Download Receipt', array('viewRect', 'id' => $model->id), array('target' => '_blank')) ?>

<?php
/* @var $this SubscriptionController */
/* @var $model Subscription */

$this->breadcrumbs=array(
	'Subscriptions'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Subscription', 'url'=>array('index','fid'=>$family->id)),
	array('label'=>'Manage Subscription', 'url'=>array('admin','fid'=>$family->id)),
);
?>

<h1>Create Subscription</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'family'=>$family,'start_dt'=>$start_dt)); ?>

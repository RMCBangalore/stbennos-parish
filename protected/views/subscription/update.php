<?php
/* @var $this SubscriptionController */
/* @var $model Subscription */

$this->breadcrumbs=array(
	'Subscriptions'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Subscription', 'url'=>array('index')),
	array('label'=>'Create Subscription', 'url'=>array('create')),
	array('label'=>'View Subscription', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Subscription', 'url'=>array('admin')),
);
?>

<h1>Update Subscription <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
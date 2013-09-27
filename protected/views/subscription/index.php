<?php
/* @var $this SubscriptionController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Subscriptions',
);

if (isset($family)) {
	$this->menu=array(
		array('label'=>'Create Subscription', 'url'=>array('create','fid'=>$family->id)),
		array('label'=>'Manage Subscription', 'url'=>array('admin','fid'=>$family->id)),
		array('label'=>'View Family','url'=>array('/family/view','id'=>$family->id)),
	);
} else {
	$this->menu=array(
		array('label'=>'Create Subscription', 'url'=>array('create')),
		array('label'=>'Manage Subscription', 'url'=>array('admin')),
	);
}
?>

<h1>Subscriptions</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

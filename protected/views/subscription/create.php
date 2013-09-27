<?php
/* @var $this SubscriptionController */
/* @var $model Subscription */

$this->breadcrumbs=array(
	'Subscriptions'=>array('index'),
	'Create',
);

if (isset($family)) {
	$this->menu=array(
		array('label'=>'List Subscription', 'url'=>array('index', 'fid' => $family->id)),
		array('label'=>'Manage Subscription', 'url'=>array('admin', 'fid' => $family->id)),
	);
} else {
	$this->menu=array(
		array('label'=>'List Subscription', 'url'=>array('index')),
		array('label'=>'Manage Subscription', 'url'=>array('admin')),
	);
}

?>

<h1>Create Subscription</h1>

<?php
$parms = array('model' => $model);
if (isset($family)) {
	$parms['family'] = $family;
	$parms['start_dt'] = $start_dt;
}
echo $this->renderPartial('_form', $parms); ?>

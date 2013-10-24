<?php
/* @var $this PastorController */
/* @var $model Pastors */

$this->breadcrumbs=array(
	'Pastors'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Pastors', 'url'=>array('index')),
	array('label'=>'Create Pastors', 'url'=>array('create')),
	array('label'=>'Update Pastors', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Pastors', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Pastors', 'url'=>array('admin')),
);
?>

<h1>View Pastors #<?php echo $model->id; ?></h1>

<?php

$this->renderPartial('_view', array('data' => $model));

?>

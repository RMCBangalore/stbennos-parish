<?php
/* @var $this NeedItemsController */
/* @var $model NeedItem */

$this->breadcrumbs=array(
	'Need Items'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List NeedItem', 'url'=>array('index')),
	array('label'=>'Create NeedItem', 'url'=>array('create')),
	array('label'=>'View NeedItem', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage NeedItem', 'url'=>array('admin')),
);
?>

<h1>Update NeedItem <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
<?php
/* @var $this AwarenessItemsController */
/* @var $model AwarenessItem */

$this->breadcrumbs=array(
	'Admin' => array('site/page', 'view' => 'admin'),
	'Awareness Items'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List AwarenessItem', 'url'=>array('index')),
	array('label'=>'Create AwarenessItem', 'url'=>array('create')),
	array('label'=>'View AwarenessItem', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage AwarenessItem', 'url'=>array('admin')),
);
?>

<h1>Update AwarenessItem <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
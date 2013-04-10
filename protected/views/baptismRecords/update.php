<?php
/* @var $this BaptismRecordsController */
/* @var $model BaptismRecord */

$this->breadcrumbs=array(
	'Baptism Records'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List BaptismRecord', 'url'=>array('index')),
	array('label'=>'Create BaptismRecord', 'url'=>array('create')),
	array('label'=>'View BaptismRecord', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage BaptismRecord', 'url'=>array('admin')),
);
?>

<h1>Update BaptismRecord <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
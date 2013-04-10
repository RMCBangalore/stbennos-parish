<?php
/* @var $this MarriageRecordsController */
/* @var $model MarriageRecord */

$this->breadcrumbs=array(
	'Marriage Records'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List MarriageRecord', 'url'=>array('index')),
	array('label'=>'Create MarriageRecord', 'url'=>array('create')),
	array('label'=>'View MarriageRecord', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage MarriageRecord', 'url'=>array('admin')),
);
?>

<h1>Update MarriageRecord <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
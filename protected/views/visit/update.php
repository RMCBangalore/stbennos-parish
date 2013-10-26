<?php
/* @var $this VisitController */
/* @var $model Visits */

$this->breadcrumbs=array(
	'Visits'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Visits', 'url'=>array('index')),
	array('label'=>'Create Visits', 'url'=>array('create')),
	array('label'=>'View Visits', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Visits', 'url'=>array('admin')),
);
?>

<h1>Update Visits <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
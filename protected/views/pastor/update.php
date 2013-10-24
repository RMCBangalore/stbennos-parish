<?php
/* @var $this PastorController */
/* @var $model Pastors */

$this->breadcrumbs=array(
	'Pastors'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Pastors', 'url'=>array('index')),
	array('label'=>'Create Pastors', 'url'=>array('create')),
	array('label'=>'View Pastors', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Pastors', 'url'=>array('admin')),
);
?>

<h1>Update Pastors <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
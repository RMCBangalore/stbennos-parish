<?php
/* @var $this SatisfactionItemController */
/* @var $model SatisfactionItems */

$this->breadcrumbs=array(
	'Satisfaction Items'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List SatisfactionItems', 'url'=>array('index')),
	array('label'=>'Create SatisfactionItems', 'url'=>array('create')),
	array('label'=>'View SatisfactionItems', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage SatisfactionItems', 'url'=>array('admin')),
);
?>

<h1>Update SatisfactionItems <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
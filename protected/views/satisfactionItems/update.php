<?php
/* @var $this SatisfactionItemsController */
/* @var $model SatisfactionItem */

$this->breadcrumbs=array(
	'Satisfaction Items'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List SatisfactionItem', 'url'=>array('index')),
	array('label'=>'Create SatisfactionItem', 'url'=>array('create')),
	array('label'=>'View SatisfactionItem', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage SatisfactionItem', 'url'=>array('admin')),
);
?>

<h1>Update SatisfactionItem <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
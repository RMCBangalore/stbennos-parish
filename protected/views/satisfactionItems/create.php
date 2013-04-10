<?php
/* @var $this SatisfactionItemsController */
/* @var $model SatisfactionItem */

$this->breadcrumbs=array(
	'Satisfaction Items'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List SatisfactionItem', 'url'=>array('index')),
	array('label'=>'Manage SatisfactionItem', 'url'=>array('admin')),
);
?>

<h1>Create SatisfactionItem</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
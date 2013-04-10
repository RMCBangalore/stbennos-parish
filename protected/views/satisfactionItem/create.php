<?php
/* @var $this SatisfactionItemController */
/* @var $model SatisfactionItems */

$this->breadcrumbs=array(
	'Satisfaction Items'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List SatisfactionItems', 'url'=>array('index')),
	array('label'=>'Manage SatisfactionItems', 'url'=>array('admin')),
);
?>

<h1>Create SatisfactionItems</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
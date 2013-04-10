<?php
/* @var $this FieldValueController */
/* @var $model FieldValues */

$this->breadcrumbs=array(
	'Field Values'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List FieldValues', 'url'=>array('index')),
	array('label'=>'Manage FieldValues', 'url'=>array('admin')),
);
?>

<h1>Create FieldValues</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
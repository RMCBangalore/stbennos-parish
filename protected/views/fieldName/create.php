<?php
/* @var $this FieldNameController */
/* @var $model FieldNames */

$this->breadcrumbs=array(
	'Field Names'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List FieldNames', 'url'=>array('index')),
	array('label'=>'Manage FieldNames', 'url'=>array('admin')),
);
?>

<h1>Create FieldNames</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
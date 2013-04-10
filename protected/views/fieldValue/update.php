<?php
/* @var $this FieldValueController */
/* @var $model FieldValues */

$this->breadcrumbs=array(
	'Field Values'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List FieldValues', 'url'=>array('index')),
	array('label'=>'Create FieldValues', 'url'=>array('create')),
	array('label'=>'View FieldValues', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage FieldValues', 'url'=>array('admin')),
);
?>

<h1>Update FieldValues <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
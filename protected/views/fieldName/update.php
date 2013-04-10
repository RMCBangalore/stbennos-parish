<?php
/* @var $this FieldNameController */
/* @var $model FieldNames */

$this->breadcrumbs=array(
	'Field Names'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List FieldNames', 'url'=>array('index')),
	array('label'=>'Create FieldNames', 'url'=>array('create')),
	array('label'=>'View FieldNames', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage FieldNames', 'url'=>array('admin')),
);
?>

<h1>Update FieldNames <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
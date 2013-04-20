<?php
/* @var $this ConfirmationRecordsController */
/* @var $model ConfirmationRecord */

$this->breadcrumbs=array(
	'Confirmation Records'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ConfirmationRecord', 'url'=>array('index')),
	array('label'=>'Manage ConfirmationRecord', 'url'=>array('admin')),
);
?>

<h1>Create Confirmation Record</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

<?php
/* @var $this MarriageRecordsController */
/* @var $model MarriageRecord */

$this->breadcrumbs=array(
	'Marriage Records'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List MarriageRecord', 'url'=>array('index')),
	array('label'=>'Manage MarriageRecord', 'url'=>array('admin')),
);
?>

<h1>Create MarriageRecord</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
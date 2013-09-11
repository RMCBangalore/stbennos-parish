<?php
/* @var $this BaptismRecordsController */
/* @var $model BaptismRecord */

$this->breadcrumbs=array(
	'Registers' => array('site/page', 'view' => 'registers'),
	'Baptism Records'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List BaptismRecord', 'url'=>array('index')),
	array('label'=>'Manage BaptismRecord', 'url'=>array('admin')),
);
?>

<h1>Create Baptism Record</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

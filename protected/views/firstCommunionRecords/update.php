<?php
/* @var $this FirstCommunionRecordsController */
/* @var $model FirstCommunionRecord */

$this->breadcrumbs=array(
       'Registers' => array('site/page', 'view' => 'registers'),
	'First Communion Records'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List FirstCommunionRecord', 'url'=>array('index')),
	array('label'=>'Create FirstCommunionRecord', 'url'=>array('create')),
	array('label'=>'View FirstCommunionRecord', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage FirstCommunionRecord', 'url'=>array('admin')),
);
?>

<h1>Update FirstCommunionRecord <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
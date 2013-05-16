<?php
/* @var $this DeathRecordsController */
/* @var $model DeathRecord */

$this->breadcrumbs=array(
	'Death Records'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List DeathRecord', 'url'=>array('index')),
	array('label'=>'Create DeathRecord', 'url'=>array('create')),
	array('label'=>'View DeathRecord', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage DeathRecord', 'url'=>array('admin')),
);
?>

<h1>Update DeathRecord <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
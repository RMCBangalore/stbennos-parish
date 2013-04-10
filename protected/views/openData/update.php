<?php
/* @var $this OpenDataController */
/* @var $model OpenData */

$this->breadcrumbs=array(
	'Open Datas'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List OpenData', 'url'=>array('index')),
	array('label'=>'Create OpenData', 'url'=>array('create')),
	array('label'=>'View OpenData', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage OpenData', 'url'=>array('admin')),
);
?>

<h1>Update OpenData <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
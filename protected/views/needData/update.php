<?php
/* @var $this NeedDataController */
/* @var $model NeedData */

$this->breadcrumbs=array(
	'Need Datas'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List NeedData', 'url'=>array('index')),
	array('label'=>'Create NeedData', 'url'=>array('create')),
	array('label'=>'View NeedData', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage NeedData', 'url'=>array('admin')),
);
?>

<h1>Update NeedData <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
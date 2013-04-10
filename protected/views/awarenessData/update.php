<?php
/* @var $this AwarenessDataController */
/* @var $model AwarenessData */

$this->breadcrumbs=array(
	'Awareness Datas'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List AwarenessData', 'url'=>array('index')),
	array('label'=>'Create AwarenessData', 'url'=>array('create')),
	array('label'=>'View AwarenessData', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage AwarenessData', 'url'=>array('admin')),
);
?>

<h1>Update AwarenessData <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
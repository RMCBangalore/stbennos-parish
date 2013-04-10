<?php
/* @var $this YesnoDataController */
/* @var $model YesnoData */

$this->breadcrumbs=array(
	'Yesno Datas'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List YesnoData', 'url'=>array('index')),
	array('label'=>'Create YesnoData', 'url'=>array('create')),
	array('label'=>'View YesnoData', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage YesnoData', 'url'=>array('admin')),
);
?>

<h1>Update YesnoData <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
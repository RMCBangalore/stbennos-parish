<?php
/* @var $this YesnoDataController */
/* @var $model YesnoData */

$this->breadcrumbs=array(
	'Yesno Datas'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List YesnoData', 'url'=>array('index')),
	array('label'=>'Manage YesnoData', 'url'=>array('admin')),
);
?>

<h1>Create YesnoData</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
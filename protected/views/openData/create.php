<?php
/* @var $this OpenDataController */
/* @var $model OpenData */

$this->breadcrumbs=array(
	'Open Datas'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List OpenData', 'url'=>array('index')),
	array('label'=>'Manage OpenData', 'url'=>array('admin')),
);
?>

<h1>Create OpenData</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
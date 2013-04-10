<?php
/* @var $this NeedDataController */
/* @var $model NeedData */

$this->breadcrumbs=array(
	'Need Datas'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List NeedData', 'url'=>array('index')),
	array('label'=>'Manage NeedData', 'url'=>array('admin')),
);
?>

<h1>Create NeedData</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
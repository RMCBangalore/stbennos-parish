<?php
/* @var $this PersonController */
/* @var $model People */

$this->breadcrumbs=array(
	'Peoples'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List People', 'url'=>array('index')),
	array('label'=>'Manage People', 'url'=>array('admin')),
);
?>

<h1>Create Person</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

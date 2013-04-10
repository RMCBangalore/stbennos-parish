<?php
/* @var $this AwarenessItemsController */
/* @var $model AwarenessItem */

$this->breadcrumbs=array(
	'Awareness Items'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List AwarenessItem', 'url'=>array('index')),
	array('label'=>'Manage AwarenessItem', 'url'=>array('admin')),
);
?>

<h1>Create AwarenessItem</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
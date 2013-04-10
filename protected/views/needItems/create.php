<?php
/* @var $this NeedItemsController */
/* @var $model NeedItem */

$this->breadcrumbs=array(
	'Need Items'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List NeedItem', 'url'=>array('index')),
	array('label'=>'Manage NeedItem', 'url'=>array('admin')),
);
?>

<h1>Create NeedItem</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
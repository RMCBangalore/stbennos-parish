<?php
/* @var $this PastorController */
/* @var $model Pastors */

$this->breadcrumbs=array(
	'Pastors'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Pastors', 'url'=>array('index')),
	array('label'=>'Manage Pastors', 'url'=>array('admin')),
);
?>

<h1>Create Pastors</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
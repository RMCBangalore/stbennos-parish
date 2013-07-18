<?php
/* @var $this FieldValueController */
/* @var $model FieldValues */

$this->breadcrumbs=array(
	'Field Values'=>array('index'),
	'Create',
);

$lbl = $_GET['type'] ? ucwords(implode(' ', explode('_', $_GET['type']))) : 'Field Values';

$this->menu=array(
	array('label'=>"List $lbl", 'url'=>array('index', 'type' => $_GET['type'])),
	array('label'=>"Manage $lbl", 'url'=>array('admin', 'type' => $_GET['type'])),
);
?>

<h1>Create <?php echo $lbl ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

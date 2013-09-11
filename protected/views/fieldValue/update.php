<?php
/* @var $this FieldValueController */
/* @var $model FieldValues */

$lbl = $_GET['type'] ? ucwords(implode(' ', explode('_', $_GET['type']))) : 'Field Values';

$lbls = preg_match('/s$/', $lbl) ? $lbl : "${lbl}s";

$this->breadcrumbs=array(
	'Admin' => array('site/page', 'view' => 'admin'),
	$lbls=>array('index', 'type' => $_GET['type']),
	$model->name=>array('view','id'=>$model->id, 'type' => $_GET['type']),
	'Update',
);

$this->menu=array(
	array('label'=>"List $lbl", 'url'=>array('index', 'type' => $_GET['type'])),
	array('label'=>"Create $lbl", 'url'=>array('create', 'type' => $_GET['type'])),
	array('label'=>"View $lbl", 'url'=>array('view', 'id'=>$model->id, 'type' => $_GET['type'])),
	array('label'=>"Manage $lbl", 'url'=>array('admin', 'type' => $_GET['type'])),
);
?>

<h1>Update <?php echo $lbl . " " . $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

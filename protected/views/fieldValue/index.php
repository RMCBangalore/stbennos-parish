<?php
/* @var $this FieldValueController */
/* @var $dataProvider CActiveDataProvider */

$lbl = $_GET['type'] ? ucwords(implode(' ', explode('_', $_GET['type']))) : 'Field Values';

$lbls = preg_match('/s$/', $lbl) ? $lbl : "${lbl}s";

$this->breadcrumbs=array(
	'Admin' => array('site/page', 'view' => 'admin'),
	$lbls,
);

$this->menu=array(
	array('label'=>"Create $lbl", 'url'=>array('create', 'type' => $_GET['type'])),
	array('label'=>"Manage $lbl", 'url'=>array('admin', 'type' => $_GET['type'])),
);
?>

<h1><?php echo $lbl ?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

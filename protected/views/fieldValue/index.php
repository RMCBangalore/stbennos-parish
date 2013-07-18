<?php
/* @var $this FieldValueController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Field Values',
);

$lbl = $_GET['type'] ? ucwords(implode(' ', explode('_', $_GET['type']))) : 'Field Values';

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

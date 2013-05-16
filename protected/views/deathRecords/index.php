<?php
/* @var $this DeathRecordsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Death Records',
);

$this->menu=array(
	array('label'=>'Create DeathRecord', 'url'=>array('create')),
	array('label'=>'Manage DeathRecord', 'url'=>array('admin')),
);
?>

<h1>Death Records</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

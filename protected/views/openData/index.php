<?php
/* @var $this OpenDataController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Open Datas',
);

$this->menu=array(
	array('label'=>'Create OpenData', 'url'=>array('create')),
	array('label'=>'Manage OpenData', 'url'=>array('admin')),
);
?>

<h1>Open Datas</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

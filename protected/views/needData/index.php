<?php
/* @var $this NeedDataController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Need Datas',
);

$this->menu=array(
	array('label'=>'Create NeedData', 'url'=>array('create')),
	array('label'=>'Manage NeedData', 'url'=>array('admin')),
);
?>

<h1>Need Datas</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

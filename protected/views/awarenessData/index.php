<?php
/* @var $this AwarenessDataController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Awareness Datas',
);

$this->menu=array(
	array('label'=>'Create AwarenessData', 'url'=>array('create')),
	array('label'=>'Manage AwarenessData', 'url'=>array('admin')),
);
?>

<h1>Awareness Datas</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

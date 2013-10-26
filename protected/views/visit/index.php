<?php
/* @var $this VisitController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Visits',
);

$this->menu=array(
	array('label'=>'Create Visits', 'url'=>array('create')),
	array('label'=>'Manage Visits', 'url'=>array('admin')),
);
?>

<h1>Visits</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

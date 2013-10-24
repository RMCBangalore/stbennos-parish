<?php
/* @var $this PastorController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Pastors',
);

$this->menu=array(
	array('label'=>'Create Pastors', 'url'=>array('create')),
	array('label'=>'Manage Pastors', 'url'=>array('admin')),
);
?>

<h1>Pastors</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

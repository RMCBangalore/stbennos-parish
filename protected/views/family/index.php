<?php
/* @var $this FamilyController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Families',
);

$this->menu=array(
	array('label'=>'Create Family', 'url'=>array('create')),
	array('label'=>'Manage Families', 'url'=>array('admin')),
);
?>

<h1>Families</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

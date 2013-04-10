<?php
/* @var $this PersonController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Peoples',
);

$this->menu=array(
	array('label'=>'Create People', 'url'=>array('create')),
	array('label'=>'Manage People', 'url'=>array('admin')),
);
?>

<h1>People</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

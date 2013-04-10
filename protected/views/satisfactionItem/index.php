<?php
/* @var $this SatisfactionItemController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Satisfaction Items',
);

$this->menu=array(
	array('label'=>'Create SatisfactionItems', 'url'=>array('create')),
	array('label'=>'Manage SatisfactionItems', 'url'=>array('admin')),
);
?>

<h1>Satisfaction Items</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

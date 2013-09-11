<?php
/* @var $this SatisfactionItemsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Admin' => array('site/page', 'view' => 'admin'),
	'Satisfaction Items',
);

$this->menu=array(
	array('label'=>'Create SatisfactionItem', 'url'=>array('create')),
	array('label'=>'Manage SatisfactionItem', 'url'=>array('admin')),
);
?>

<h1>Satisfaction Items</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

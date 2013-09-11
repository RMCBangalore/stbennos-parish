<?php
/* @var $this NeedItemsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Admin' => array('site/page', 'view' => 'admin'),
	'Need Items',
);

$this->menu=array(
	array('label'=>'Create NeedItem', 'url'=>array('create')),
	array('label'=>'Manage NeedItem', 'url'=>array('admin')),
);
?>

<h1>Need Items</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

<?php
/* @var $this AwarenessItemsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Awareness Items',
);

$this->menu=array(
	array('label'=>'Create AwarenessItem', 'url'=>array('create')),
	array('label'=>'Manage AwarenessItem', 'url'=>array('admin')),
);
?>

<h1>Awareness Items</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

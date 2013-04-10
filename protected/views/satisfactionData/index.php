<?php
/* @var $this SatisfactionDataController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Satisfaction Datas',
);

$this->menu=array(
	array('label'=>'Create SatisfactionData', 'url'=>array('create')),
	array('label'=>'Manage SatisfactionData', 'url'=>array('admin')),
);
?>

<h1>Satisfaction Datas</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

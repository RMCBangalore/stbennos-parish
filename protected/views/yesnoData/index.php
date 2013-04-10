<?php
/* @var $this YesnoDataController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Yesno Datas',
);

$this->menu=array(
	array('label'=>'Create YesnoData', 'url'=>array('create')),
	array('label'=>'Manage YesnoData', 'url'=>array('admin')),
);
?>

<h1>Yesno Datas</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

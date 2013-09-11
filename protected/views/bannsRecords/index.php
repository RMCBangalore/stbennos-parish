<?php
/* @var $this BannsRecordsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
       'Registers' => array('site/page', 'view' => 'registers'),
	'Banns Records',
);

$this->menu=array(
	array('label'=>'Create BannsRecord', 'url'=>array('create')),
	array('label'=>'Manage BannsRecord', 'url'=>array('admin')),
);
?>

<h1>Banns Records</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

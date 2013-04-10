<?php
/* @var $this FirstCommunionCertificateController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'First Communion Certificates',
);

$this->menu=array(
	array('label'=>'Create FirstCommunionCertificate', 'url'=>array('create')),
	array('label'=>'Manage FirstCommunionCertificate', 'url'=>array('admin')),
);
?>

<h1>First Communion Certificates</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

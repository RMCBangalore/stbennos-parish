<?php
/* @var $this BaptismCertificateController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Baptism Certificates',
);

$this->menu=array(
	array('label'=>'Create BaptismCertificate', 'url'=>array('create')),
	array('label'=>'Manage BaptismCertificate', 'url'=>array('admin')),
);
?>

<h1>Baptism Certificates</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

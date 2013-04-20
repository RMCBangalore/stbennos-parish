<?php
/* @var $this ConfirmationCertificatesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Confirmation Certificates',
);

$this->menu=array(
	array('label'=>'Create ConfirmationCertificate', 'url'=>array('create')),
	array('label'=>'Manage ConfirmationCertificate', 'url'=>array('admin')),
);
?>

<h1>Confirmation Certificates</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

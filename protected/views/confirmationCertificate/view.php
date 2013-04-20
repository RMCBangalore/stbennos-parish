<?php
/* @var $this ConfirmationCertificatesController */
/* @var $model ConfirmationCertificate */

$this->breadcrumbs=array(
	'Confirmation Certificates'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List ConfirmationCertificate', 'url'=>array('index')),
	array('label'=>'Create ConfirmationCertificate', 'url'=>array('create')),
	array('label'=>'Update ConfirmationCertificate', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ConfirmationCertificate', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ConfirmationCertificate', 'url'=>array('admin')),
);
?>

<h1>View ConfirmationCertificate #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'cert_dt',
		'confirmation_id',
	),
)); ?>

<?php echo CHtml::link('Download Certificate', array('viewCert', 'id' => $model->id)); ?>


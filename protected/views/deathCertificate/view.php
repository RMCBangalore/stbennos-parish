<?php
/* @var $this DeathCertificateController */
/* @var $model DeathCertificate */

$this->breadcrumbs=array(
	'Death Certificates'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List DeathCertificate', 'url'=>array('index')),
	array('label'=>'Create DeathCertificate', 'url'=>array('create')),
	array('label'=>'Update DeathCertificate', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete DeathCertificate', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage DeathCertificate', 'url'=>array('admin')),
);
?>

<h1>View DeathCertificate #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'death_id',
		'cert_dt',
	),
)); ?>

<?php echo CHtml::link('Download Certificate', array('viewCert', 'id' => $model->id)); ?>


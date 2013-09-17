<?php
/* @var $this FirstCommunionCertificateController */
/* @var $model FirstCommunionCertificate */

$this->breadcrumbs=array(
       'Certificates' => array('site/page', 'view' => 'certificates'),
	'First Communion Certificates'=>array('index'),
	$model->id,
);

$this->menu=array(
 	array('label'=>'Create FirstCommunionRecord', 'url'=>array('/firstCommunionRecords/create')),
	array('label'=>'List FirstCommunionCertificate', 'url'=>array('index')),
	array('label'=>'Update FirstCommunionCertificate', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete FirstCommunionCertificate', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage FirstCommunionCertificate', 'url'=>array('admin')),
);
?>

<h1>View FirstCommunionCertificate #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'cert_dt',
		'first_comm_id',
	),
)); ?>

<?php echo CHtml::link('Download Certificate', array('viewCert', 'id' => $model->id), array('target' => '_blank')); ?>

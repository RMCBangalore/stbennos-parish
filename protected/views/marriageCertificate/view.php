<?php
/* @var $this MarriageCertificateController */
/* @var $model MarriageCertificate */

$this->breadcrumbs=array(
	'Marriage Certificates'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List MarriageCertificate', 'url'=>array('index')),
	array('label'=>'Create MarriageCertificate', 'url'=>array('create')),
	array('label'=>'Update MarriageCertificate', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete MarriageCertificate', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage MarriageCertificate', 'url'=>array('admin')),
);
?>

<h1>View MarriageCertificate #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'cert_dt',
		'marriage_id',
	),
)); ?>

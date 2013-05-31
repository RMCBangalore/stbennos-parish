<?php
/* @var $this BaptismCertificateController */
/* @var $model BaptismCertificate */

$this->breadcrumbs=array(
	'Baptism Certificates'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List BaptismCertificate', 'url'=>array('index')),
	array('label'=>'Create BaptismCertificate', 'url'=>array('create')),
	array('label'=>'Update BaptismCertificate', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete BaptismCertificate', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage BaptismCertificate', 'url'=>array('admin')),
);
?>

<h1>View BaptismCertificate #<?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('../baptismRecords/_view_fields', array('data' => $model->baptism)); ?>

<b><?php echo CHtml::encode($model->getAttributeLabel('cert_dt')); ?>:</b>
<?php echo CHtml::encode($model->cert_dt); ?>
<br />

<?php echo CHtml::link('Download Certificate', array('viewCert', 'id' => $model->id), array('target' => '_blank')) ?>


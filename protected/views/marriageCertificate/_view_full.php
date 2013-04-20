<?php
/* @var $this MarriageCertificateController */
/* @var $data MarriageCertificate */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cert_dt')); ?>:</b>
	<?php echo CHtml::encode($data->cert_dt); ?>
	<br />

	<?php $this->renderPartial('../marriageRecords/_view_cert', array('model' => $data, 'data' => $data->marriage)); ?>

	<?php echo CHtml::link('Download Certificate', array('viewCert', 'id'=>$data->id), array('target' => '_blank')) ?>

</div>

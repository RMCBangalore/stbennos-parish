<?php
/* @var $this BaptismCertificateController */
/* @var $data BaptismCertificate */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cert_dt')); ?>:</b>
	<?php echo CHtml::encode($data->cert_dt); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('baptism_id')); ?>:</b>
	<?php echo CHtml::encode($data->baptism_id); ?>
	<br />


</div>
<?php
/* @var $this FirstCommunionCertificateController */
/* @var $data FirstCommunionCertificate */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cert_dt')); ?>:</b>
	<?php echo CHtml::encode($data->cert_dt); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('first_comm_id')); ?>:</b>
	<?php echo CHtml::encode($data->first_comm_id); ?>
	<br />


</div>
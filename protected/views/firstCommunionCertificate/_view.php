<?php
/* @var $this FirstCommunionCertificateController */
/* @var $data FirstCommunionCertificate */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<?php echo $this->renderPartial('../firstCommunionRecords/_view_fields', array('data' => $data->firstCommunion)); ?>

	<b><?php echo CHtml::encode($data->getAttributeLabel('cert_dt')); ?>:</b>
	<?php echo CHtml::encode($data->cert_dt); ?>
	<br />

</div>

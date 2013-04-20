<?php
/* @var $this MarriageCertificateController */
/* @var $data MarriageCertificate */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<?php $this->renderPartial('_view_full', array('model' => $data, 'data' => $data->marriage)); ?>

	<b><?php echo CHtml::encode($data->getAttributeLabel('cert_dt')); ?>:</b>
	<?php echo CHtml::encode($data->cert_dt); ?>
	<br />

</div>

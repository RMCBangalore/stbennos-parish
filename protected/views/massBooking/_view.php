<?php
/* @var $this MassBookingController */
/* @var $data MassBooking */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mass_dt')); ?>:</b>
	<?php echo CHtml::encode($data->mass_dt); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mass_id')); ?>:</b>
	<?php echo CHtml::encode($data->mass_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('booked_by')); ?>:</b>
	<?php echo CHtml::encode($data->booked_by); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('intention')); ?>:</b>
	<?php echo CHtml::encode($data->intention); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('trans_id')); ?>:</b>
	<?php echo CHtml::encode($data->trans_id); ?>
	<br />


</div>

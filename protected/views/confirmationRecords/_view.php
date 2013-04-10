<?php
/* @var $this ConfirmationRecordsController */
/* @var $data ConfirmationRecord */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('confirmation_dt')); ?>:</b>
	<?php echo CHtml::encode($data->confirmation_dt); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('church')); ?>:</b>
	<?php echo CHtml::encode($data->church); ?>
	<br />


</div>
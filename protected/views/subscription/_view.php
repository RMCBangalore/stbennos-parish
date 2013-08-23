<?php
/* @var $this SubscriptionController */
/* @var $data Subscription */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('family_id')); ?>:</b>
	<?php echo CHtml::encode($data->family_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('trans_id')); ?>:</b>
	<?php echo CHtml::encode($data->trans_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('start_month')); ?>:</b>
	<?php echo CHtml::encode($data->start_month); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('start_year')); ?>:</b>
	<?php echo CHtml::encode($data->start_year); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('end_month')); ?>:</b>
	<?php echo CHtml::encode($data->end_month); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('end_year')); ?>:</b>
	<?php echo CHtml::encode($data->end_year); ?>
	<br />

</div>

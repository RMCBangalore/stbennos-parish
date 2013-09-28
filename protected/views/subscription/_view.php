<?php
/* @var $this SubscriptionController */
/* @var $data Subscription */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode('Family'); ?>:</b>
	<?php echo CHtml::encode($data->family->head_name . ' #' . $data->family_id); ?>
	<br />

	<b><?php echo CHtml::encode('From month'); ?>:</b>
	<?php echo date_format(new DateTime(implode("-",array($data->start_year,$data->start_month,1))), "M, Y"); ?>
	<br />


	<b><?php echo CHtml::encode('Till month'); ?>:</b>
	<?php echo date_format(new DateTime(implode("-",array($data->end_year,$data->end_month,1))), "M, Y"); ?>
	<br />

	<b><?php echo CHtml::encode('Monthly Amt') . ' &#8377;'; ?>:</b>
	<?php echo CHtml::encode($data->amount); ?>
	<br />

	<b><?php echo CHtml::encode('Total Amount') . ' &#8377;'; ?>:</b>
	<?php echo CHtml::encode($data->trans->amount); ?>
	<br />

</div>

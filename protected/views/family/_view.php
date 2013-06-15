<?php
/* @var $this FamilyController */
/* @var $data Families */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fid')); ?>:</b>
	<?php echo CHtml::encode($data->fid); ?>
	<br />

	<?php if ($data->head()) {
		$head = $data->head();
		echo '<b>' . CHtml::encode('Family head') . ':</b> ';
		echo CHtml::encode($head->fullname());
		echo '<br />';
	} ?>

	<b><?php echo CHtml::encode($data->getAttributeLabel('addr_nm')); ?>:</b>
	<?php echo CHtml::encode($data->addr_nm); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('addr_stt')); ?>:</b>
	<?php echo CHtml::encode($data->addr_stt); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('addr_area')); ?>:</b>
	<?php echo CHtml::encode($data->addr_area); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('addr_pin')); ?>:</b>
	<?php echo CHtml::encode($data->addr_pin); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('phone')); ?>:</b>
	<?php echo CHtml::encode($data->phone); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('mobile')); ?>:</b>
	<?php echo CHtml::encode($data->mobile); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('zone')); ?>:</b>
	<?php echo CHtml::encode($data->zone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('yr_reg')); ?>:</b>
	<?php echo CHtml::encode($data->yr_reg); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bpl_card')); ?>:</b>
	<?php echo CHtml::encode($data->bpl_card); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('marriage_church')); ?>:</b>
	<?php echo CHtml::encode($data->marriage_church); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('marriage_date')); ?>:</b>
	<?php echo CHtml::encode($data->marriage_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('marriage_type')); ?>:</b>
	<?php echo CHtml::encode($data->marriage_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('marriage_status')); ?>:</b>
	<?php echo CHtml::encode($data->marriage_status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('monthly_income')); ?>:</b>
	<?php echo CHtml::encode($data->monthly_income); ?>
	<br />

	*/ ?>


</div>

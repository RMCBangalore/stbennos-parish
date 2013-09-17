<?php
/* @var $this PersonController */
/* @var $data People */
?>

<div class="view">

	<?php if (!$data) { ?>
		No data exists
	<?php } else { ?>

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mid')); ?>:</b>
	<?php echo CHtml::encode($data->mid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fname')); ?>:</b>
	<?php echo CHtml::encode($data->fname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lname')); ?>:</b>
	<?php echo CHtml::encode($data->lname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sex')); ?>:</b>
	<?php echo CHtml::encode(isset($data->sex) ? FieldNames::value('sex', $data->sex) : ''); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('domicile_status')); ?>:</b>
	<?php echo $data->domicile_status ? CHtml::encode(FieldNames::value('domicile_status', $data->domicile_status)) : ''; ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dob')); ?>:</b>
	<?php echo CHtml::encode($data->dob); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('education')); ?>:</b>
	<?php echo CHtml::encode(isset($data->education) ? FieldNames::value('education', $data->education) : ''); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('profession')); ?>:</b>
	<?php echo CHtml::encode($data->profession); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('occupation')); ?>:</b>
	<?php echo CHtml::encode($data->occupation); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mobile')); ?>:</b>
	<?php echo CHtml::encode($data->mobile); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lang_pri')); ?>:</b>
	<?php echo CHtml::encode($data->lang_pri); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lang_lit')); ?>:</b>
	<?php echo CHtml::encode($data->lang_lit); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lang_edu')); ?>:</b>
	<?php echo CHtml::encode($data->lang_edu); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rite')); ?>:</b>
	<?php echo CHtml::encode($data->rite); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('baptism_dt')); ?>:</b>
	<?php echo CHtml::encode($data->baptism_dt); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('baptism_church')); ?>:</b>
	<?php echo CHtml::encode($data->baptism_church); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('baptism_place')); ?>:</b>
	<?php echo CHtml::encode($data->baptism_place); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('god_parents')); ?>:</b>
	<?php echo CHtml::encode($data->god_parents); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('first_comm_dt')); ?>:</b>
	<?php echo CHtml::encode($data->first_comm_dt); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('confirmation_dt')); ?>:</b>
	<?php echo CHtml::encode($data->confirmation_dt); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('marriage_dt')); ?>:</b>
	<?php echo CHtml::encode($data->marriage_dt); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cemetery_church')); ?>:</b>
	<?php echo CHtml::encode($data->cemetery_church); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('family_id')); ?>:</b>
	<?php echo CHtml::encode($data->family_id); ?>
	<br />

	*/ ?>
	<?php } ?>

</div>

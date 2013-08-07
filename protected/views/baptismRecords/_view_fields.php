
	<b><?php echo CHtml::encode($data->getAttributeLabel('ref_no')); ?>:</b>
	<?php echo CHtml::encode($data->ref_no); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dob')); ?>:</b>
	<?php echo CHtml::encode($data->dob); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('baptism_dt')); ?>:</b>
	<?php echo CHtml::encode($data->baptism_dt); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sex')); ?>:</b>
	<?php echo CHtml::encode(isset($data->sex) ? FieldNames::value('sex', $data->sex) : ''); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fathers_name')); ?>:</b>
	<?php echo CHtml::encode($data->fathers_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mothers_name')); ?>:</b>
	<?php echo CHtml::encode($data->mothers_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mother_tongue')); ?>:</b>
	<?php echo CHtml::encode($data->mother_tongue); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('baptism_place')); ?>:</b>
	<?php echo CHtml::encode($data->baptism_place); ?>
	<br />


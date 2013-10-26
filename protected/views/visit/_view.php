<?php
/* @var $this VisitController */
/* @var $data Visits */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pastor_id')); ?>:</b>
	<?php echo CHtml::encode($data->pastor->fullname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('visit_dt')); ?>:</b>
	<?php echo CHtml::encode($data->visit_dt); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('purpose')); ?>:</b>
	<?php echo CHtml::encode(FieldNames::value('visit_purpose', $data->purpose)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('family_id')); ?>:</b>
	<?php echo CHtml::encode($data->family_id); ?>
	<br />


</div>

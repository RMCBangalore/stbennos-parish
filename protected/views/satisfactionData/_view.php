<?php
/* @var $this SatisfactionDataController */
/* @var $data SatisfactionData */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('family_id')); ?>:</b>
	<?php echo CHtml::encode($data->family_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('satisfaction_item_id')); ?>:</b>
	<?php echo CHtml::encode($data->satisfaction_item_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('satisfaction_value')); ?>:</b>
	<?php echo CHtml::encode($data->satisfaction_value); ?>
	<br />


</div>
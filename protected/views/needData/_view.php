<?php
/* @var $this NeedDataController */
/* @var $data NeedData */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('family_id')); ?>:</b>
	<?php echo CHtml::encode($data->family_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('need_id')); ?>:</b>
	<?php echo CHtml::encode($data->need_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('need_value')); ?>:</b>
	<?php echo CHtml::encode($data->need_value); ?>
	<br />


</div>
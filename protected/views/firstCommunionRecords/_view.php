<?php
/* @var $this FirstCommunionRecordsController */
/* @var $data FirstCommunionRecord */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('communion_dt')); ?>:</b>
	<?php echo CHtml::encode($data->communion_dt); ?>
	<br />


</div>

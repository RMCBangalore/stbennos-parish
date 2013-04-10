<?php
/* @var $this AwarenessDataController */
/* @var $data AwarenessData */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('family_id')); ?>:</b>
	<?php echo CHtml::encode($data->family_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('aware')); ?>:</b>
	<?php echo CHtml::encode($data->aware); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('accessed')); ?>:</b>
	<?php echo CHtml::encode($data->accessed); ?>
	<br />


</div>
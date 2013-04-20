<?php
/* @var $this BaptismRecordsController */
/* @var $data BaptismRecord */
?>

<div class="view">

	<?php $this->renderPartial('_view_fields', array('data' => $data)); ?>
	
	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('residence')); ?>:</b>
	<?php echo CHtml::encode($data->residence); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('godfathers_name')); ?>:</b>
	<?php echo CHtml::encode($data->godfathers_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('godmothers_name')); ?>:</b>
	<?php echo CHtml::encode($data->godmothers_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('minister')); ?>:</b>
	<?php echo CHtml::encode($data->minister); ?>
	<br />

	*/ ?>

	<?php echo CHtml::link('Create Certificate', array('baptismCertificate/create', 'bid' => $data->id)) ?>

</div>

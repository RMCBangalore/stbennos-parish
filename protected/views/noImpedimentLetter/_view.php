<?php
/* @var $this NoImpedimentLetterController */
/* @var $data NoImpedimentLetter */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<?php echo $this->renderPartial('../bannsRecords/_view_fields', array('data' => $data->banns)); ?>

	<b><?php echo CHtml::encode($data->getAttributeLabel('letter_dt')); ?>:</b>
	<?php echo CHtml::encode($data->letter_dt); ?>
	<br />


</div>

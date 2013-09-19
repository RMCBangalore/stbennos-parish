<?php
/* @var $this BaptismRecordsController */
/* @var $data BaptismRecord */
?>

<div class="view">

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
	<?php echo CHtml::encode($data->sex); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fathers_name')); ?>:</b>
	<?php echo CHtml::encode($data->fathers_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mothers_name')); ?>:</b>
	<?php echo CHtml::encode($data->mothers_name); ?>
	<br />

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

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'baptism-certificate-form',
	'enableAjaxValidation'=>false,
)); ?>

	<!--p class="note">Fields with <span class="required">*</span> are required.</p-->

	<div class="row">
		<?php echo $form->labelEx($model,'cert_dt'); ?>
		<?php echo $form->textField($model,'cert_dt',array('size'=>15,'maxlength'=>75,'value'=>$now, 'readonly' => 1)); ?>
		<?php echo $form->error($model,'cert_dt'); ?>
	</div>

		<?php echo $form->hiddenField($model,'baptism_id',array('value'=>$data->id)); ?>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

</div>

<?php
/* @var $this FirstCommunionCertificateController */
/* @var $model FirstCommunionCertificate */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'first-communion-certificate-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'cert_dt'); ?>
		<?php echo $form->textField($model,'cert_dt'); ?>
		<?php echo $form->error($model,'cert_dt'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'first_comm_id'); ?>
		<?php echo $form->textField($model,'first_comm_id'); ?>
		<?php echo $form->error($model,'first_comm_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
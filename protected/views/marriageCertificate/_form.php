<?php
/* @var $this MarriageCertificateController */
/* @var $model MarriageCertificate */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'marriage-certificate-form',
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
		<?php echo $form->labelEx($model,'marriage_id'); ?>
		<?php echo $form->textField($model,'marriage_id'); ?>
		<?php echo $form->error($model,'marriage_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<?php
/* @var $this BaptismCertificateController */
/* @var $model BaptismCertificate */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'baptism-certificate-form',
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
		<?php echo $form->labelEx($model,'baptism_id'); ?>
		<?php echo $form->textField($model,'baptism_id'); ?>
		<?php echo $form->error($model,'baptism_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
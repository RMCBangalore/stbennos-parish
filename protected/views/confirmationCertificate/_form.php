<?php
/* @var $this ConfirmationCertificatesController */
/* @var $model ConfirmationCertificate */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'confirmation-certificate-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->hiddenField($model, 'confirmation_id', array('value' => $confirmation->id)); ?>

	<?php echo $this->renderPartial('../confirmationRecords/_view_fields', array('data' => $confirmation)) ?>

	<div class="row">
		<?php echo $form->labelEx($model,'cert_dt'); ?>
		<?php echo $form->textField($model,'cert_dt',array('readonly'=>1,'value'=>date_format(new DateTime(),'Y-m-d'))); ?>
		<?php echo $form->error($model,'cert_dt'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

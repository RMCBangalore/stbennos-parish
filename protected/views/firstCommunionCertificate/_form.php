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

	<?php echo $this->renderPartial('../firstCommunionRecords/_view_fields', array('data' => $firstCommunion)); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'cert_dt'); ?>
		<?php echo $form->textField($model,'cert_dt',array('value' => $now)); ?>
		<?php echo $form->error($model,'cert_dt'); ?>
	</div>

	<?php echo $form->hiddenField($model, 'first_comm_id', array('value' => $firstCommunion->id)); ?>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

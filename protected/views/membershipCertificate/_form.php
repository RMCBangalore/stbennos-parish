<?php
/* @var $this MembershipCertificateController */
/* @var $model MembershipCertificate */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'membership-certificate-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->hiddenField($model,'member_id', array('value' => $member->id)); ?>

	<?php echo $this->renderPartial('../person/_member_fields', array('data' => $member)) ?>

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

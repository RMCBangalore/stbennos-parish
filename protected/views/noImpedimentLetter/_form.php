<?php
/* @var $this NoImpedimentLetterController */
/* @var $model NoImpedimentLetter */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'no-impediment-letter-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'banns_id'); ?>
		<?php echo $form->textField($model,'banns_id'); ?>
		<?php echo $form->error($model,'banns_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'letter_dt'); ?>
		<?php echo $form->textField($model,'letter_dt'); ?>
		<?php echo $form->error($model,'letter_dt'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
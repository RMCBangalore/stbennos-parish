<?php
/* @var $this AwarenessDataController */
/* @var $model AwarenessData */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'awareness-data-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'family_id'); ?>
		<?php echo $form->textField($model,'family_id'); ?>
		<?php echo $form->error($model,'family_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'aware'); ?>
		<?php echo $form->textField($model,'aware'); ?>
		<?php echo $form->error($model,'aware'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'accessed'); ?>
		<?php echo $form->textField($model,'accessed'); ?>
		<?php echo $form->error($model,'accessed'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<?php
/* @var $this SatisfactionDataController */
/* @var $model SatisfactionData */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'satisfaction-data-form',
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
		<?php echo $form->labelEx($model,'satisfaction_item_id'); ?>
		<?php echo $form->textField($model,'satisfaction_item_id'); ?>
		<?php echo $form->error($model,'satisfaction_item_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'satisfaction_value'); ?>
		<?php echo $form->textField($model,'satisfaction_value'); ?>
		<?php echo $form->error($model,'satisfaction_value'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
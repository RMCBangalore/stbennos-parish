<?php
/* @var $this AccountController */
/* @var $model Account */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'account-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'parent'); ?>
		<?php echo $form->dropDownList($model,'parent',Account::values()); ?>
		<?php echo $form->error($model,'parent'); ?>
	</div>

	<div class="row">
	<span class="leftHalf">
		<?php echo $form->labelEx($model,'placeholder'); ?>
		<?php echo $form->checkBox($model,'placeholder'); ?>
		<?php echo $form->error($model,'placeholder'); ?>
	</span>
	<span class="rightHalf">
		<?php echo $form->labelEx($model,'reserved'); ?>
		<?php echo $form->checkBox($model,'reserved'); ?>
		<?php echo $form->error($model,'reserved'); ?>
	</span>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
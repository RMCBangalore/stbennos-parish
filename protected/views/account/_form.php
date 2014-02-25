<?php
/* @var $this AccountController */
/* @var $model Account */
/* @var $form CActiveForm */

Yii::app()->clientScript->registerScript('parent_select', "
$(document).ready(function() {
	$('#Account_parent').change(function(e) {
		$.get('" . Yii::app()->createUrl('/account/get') . "/' + this.value, function(acc) {

			$('#Account_type').val(acc.type);
		}, 'json' );
	} );
} );
");
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
	<span class="leftHalf">
		<?php echo $form->labelEx($model,'parent'); ?>
		<?php echo $form->dropDownList($model, 'parent', Account::values(),
			array('prompt' => '-- Select one --')); ?>
		<?php echo $form->error($model,'parent'); ?>
	</span>
	<span class="rightHalf">
		<?php echo $form->labelEx($model,'type'); ?>
		<?php echo $form->dropDownList($model,'type', array(
			'credit' => 'Credit',
			'debit' => 'Debit'
		), array('prompt' => '-- Select --')); ?>
		<?php echo $form->error($model, 'type'); ?>
	</span>
	</div>

	<div class="row">
	<span class="leftHalf">
		<?php echo $form->labelEx($model,'placeholder'); ?>
		<?php echo $form->checkBox($model,'placeholder',array('uncheckValue'=>null)); ?>
		<?php echo $form->error($model,'placeholder'); ?>
	</span>
	<span class="rightHalf">
		<?php echo $form->labelEx($model,'reserved'); ?>
		<?php echo $form->checkBox($model,'reserved',array('uncheckValue'=>null)); ?>
		<?php echo $form->error($model,'reserved'); ?>
	</span>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

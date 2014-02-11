<?php
/* @var $this TransactionController */
/* @var $model Transaction */
/* @var $form CActiveForm */

Yii::app()->clientScript->registerScript('parent_select', "
$(document).ready(function() {
	$('#Transaction_account_id').change(function(e) {
		$.get('" . Yii::app()->createUrl('/account/get') . "/' + this.value, function(acc) {

			$('#Transaction_type').val(acc.type);
		}, 'json' );
	} );
} );
");
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'transaction-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
	<span class="leftHalf">
		<?php echo $form->labelEx($model, 'account_id'); ?>
		<?php echo $form->dropDownList($model, 'account_id', Account::selectables(), array(
			'prompt' => '-- Select one --'
		)); ?>
		<?php echo $form->error($model, 'account_id'); ?>
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
		<?php echo $form->labelEx($model,'descr'); ?>
		<?php echo $form->textField($model,'descr',array('size'=>60,'maxlength'=>99)); ?>
		<?php echo $form->error($model,'descr'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'amount'); ?>
		<?php echo $form->textField($model,'amount'); ?>
		<?php echo $form->error($model,'amount'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

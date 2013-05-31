<?php
/* @var $this BannsResponseController */
/* @var $model BannsResponse */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'banns-response-form',
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
		<?php echo $form->labelEx($model,'res_dt'); ?>
		<?php echo $form->textField($model,'res_dt'); ?>
		<?php echo $form->error($model,'res_dt'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<?php
/* @var $this ConfirmationRecordsController */
/* @var $model ConfirmationRecord */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'confirmation-record-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>75)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'church'); ?>
		<?php echo $form->textField($model,'church',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'church'); ?>
	</div>

	<div class="row">
	<span class="leftHalf">
		<?php echo $form->labelEx($model,'confirmation_dt'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'attribute' => "confirmation_dt",
			'options'	=> array(
				'dateFormat' => 'yy-mm-dd',
				'changeYear' => true
			),
			'htmlOptions' => array(
				'size' => '10',         // textField size
				'maxlength' => '10',    // textField maxlength
			),
		)); ?>
		<?php echo $form->error($model,'confirmation_dt'); ?>
	</span>
	<span class="rightHalf">
		<?php echo $form->labelEx($model,'dob'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'attribute' => "dob",
			'options'	=> array(
				'dateFormat' => 'yy-mm-dd',
				'changeYear' => true
			),
			'htmlOptions' => array(
				'size' => '10',         // textField size
				'maxlength' => '10',    // textField maxlength
			),
		)); ?>
		<?php echo $form->error($model,'dob'); ?>
	</span>
	</div>

	<div class="row">
	<span class="leftHalf">
		<?php echo $form->labelEx($model,'baptism_dt'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'attribute' => "baptism_dt",
			'options'	=> array(
				'dateFormat' => 'yy-mm-dd',
				'changeYear' => true
			),
			'htmlOptions' => array(
				'size' => '10',         // textField size
				'maxlength' => '10',    // textField maxlength
			),
		)); ?>
		<?php echo $form->error($model,'baptism_dt'); ?>
	</span>
	<span class="rightHalf">
		<?php echo $form->labelEx($model,'baptism_place'); ?>
		<?php echo $form->textField($model,'baptism_place',array('size'=>25,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'baptism_place'); ?>
	</span>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'parents_name'); ?>
		<?php echo $form->textField($model,'parents_name',array('size'=>50,'maxlength'=>75)); ?>
		<?php echo $form->error($model,'parents_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'godparent_name'); ?>
		<?php echo $form->textField($model,'godparent_name',array('size'=>50,'maxlength'=>75)); ?>
		<?php echo $form->error($model,'godparent_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'residence'); ?>
		<?php echo $form->textField($model,'residence',array('size'=>50,'maxlength'=>75)); ?>
		<?php echo $form->error($model,'residence'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'minister'); ?>
		<?php echo $form->textField($model,'minister',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'minister'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

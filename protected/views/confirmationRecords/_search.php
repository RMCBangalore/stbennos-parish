<?php
/* @var $this ConfirmationRecordsController */
/* @var $model ConfirmationRecord */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>75)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'confirmation_dt'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'attribute' => 'confirmation_dt',
			'options'	=> array(
				'dateFormat' => 'yy-mm-dd',
				'changeYear' => true
			),
			'htmlOptions' => array(
				'size' => '10',         // textField size
				'maxlength' => '10',    // textField maxlength
			),
		)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'dob'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'attribute' => 'dob',
			'options'	=> array(
				'dateFormat' => 'yy-mm-dd',
				'changeYear' => true
			),
			'htmlOptions' => array(
				'size' => '10',         // textField size
				'maxlength' => '10',    // textField maxlength
			),
		)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'baptism_dt'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'attribute' => 'baptism_dt',
			'options'	=> array(
				'dateFormat' => 'yy-mm-dd',
				'changeYear' => true
			),
			'htmlOptions' => array(
				'size' => '10',         // textField size
				'maxlength' => '10',    // textField maxlength
			),
		)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'baptism_place'); ?>
		<?php echo $form->textField($model,'baptism_place',array('size'=>40,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'parents_name'); ?>
		<?php echo $form->textField($model,'parents_name',array('size'=>50,'maxlength'=>75)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'residence'); ?>
		<?php echo $form->textField($model,'residence',array('size'=>40,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'godparent_name'); ?>
		<?php echo $form->textField($model,'godparent_name',array('size'=>50,'maxlength'=>75)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'minister'); ?>
		<?php echo $form->textField($model,'minister',array('size'=>40,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'church'); ?>
		<?php echo $form->textField($model,'church',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->

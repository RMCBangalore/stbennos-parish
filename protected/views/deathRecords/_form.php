<?php
/* @var $this DeathRecordsController */
/* @var $model DeathRecord */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'death-record-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
	<span class="leftHalf">
		<?php echo $form->labelEx($model,'fname'); ?>
		<?php echo $form->textField($model,'fname',array('size'=>25,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'fname'); ?>
	</span>
	<span class="rightHalf">
		<?php echo $form->labelEx($model,'lname'); ?>
		<?php echo $form->textField($model,'lname',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'lname'); ?>
	</span>
	</div>

	<div class="row">
	<span class="leftHalf">
		<?php echo $form->labelEx($model,'profession'); ?>
		<?php echo $form->textField($model,'profession',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'profession'); ?>
	</span>
	<span class="rightHalf">
		<?php echo $form->labelEx($model,'age'); ?>
		<?php echo $form->textField($model,'age'); ?>
		<?php echo $form->error($model,'age'); ?>
	</span>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'death_dt'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'attribute' => 'death_dt',
			'options'	=> array(
				'dateFormat' => 'yy-mm-dd',
				'changeYear' => true
			),
			'htmlOptions' => array(
				'size' => '10',         // textField size
				'maxlength' => '10',    // textField maxlength
			),
		)); ?>
		<?php echo $form->error($model,'death_dt'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cause'); ?>
		<?php echo $form->textField($model,'cause',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'cause'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'minister'); ?>
		<?php echo $form->textField($model,'minister',array('size'=>60,'maxlength'=>75)); ?>
		<?php echo $form->error($model,'minister'); ?>
	</div>

	<div class="row">
	<span class="leftHalf">
		<?php echo $form->labelEx($model,'buried_dt'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'attribute' => 'buried_dt',
			'options'	=> array(
				'dateFormat' => 'yy-mm-dd',
				'changeYear' => true
			),
			'htmlOptions' => array(
				'size' => '10',         // textField size
				'maxlength' => '10',    // textField maxlength
			),
		)); ?>
		<?php echo $form->error($model,'buried_dt'); ?>
	</span>
	<span class="rightHalf">
		<?php echo $form->labelEx($model,'burial_place'); ?>
		<?php echo $form->textField($model,'burial_place',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'burial_place'); ?>
	</span>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

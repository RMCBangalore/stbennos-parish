<?php
/* @var $this MarriageRecordsController */
/* @var $model MarriageRecord */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'marriage-record-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php $form->widget('CTabView', array(
		'tabs' => array(
			'tab1' => array(
				'title'	=> 'Groom Details',
				'view'	=> '_groom_form',
				'data'	=> array(
					'form'	=> $form,
					'model'	=> $model
				),
			),
			'tab2' => array(
				'title'	=> 'Bride Details',
				'view'	=> '_bride_form',
				'data'	=> array(
					'form'	=> $form,
					'model'	=> $model
				),
			)
		)
	)); ?>

	<div class="row">
	<span class="leftHalf">
		<?php echo $form->labelEx($model,'marriage_dt'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'attribute' => "marriage_dt",
			'options'	=> array(
				'dateFormat' => 'yy-mm-dd',
				'changeYear' => true
			),
			'htmlOptions' => array(
				'size' => '10',         // textField size
				'maxlength' => '10',    // textField maxlength
			),
		)); ?>
		<?php echo $form->error($model,'marriage_dt'); ?>
	</span>
	<span class="rightHalf">
		<?php echo $form->labelEx($model,'banns_licence'); ?>
		<?php echo $form->dropDownList($model,'banns_licence',array('banns' => 'Banns', 'licence' => 'Licence'), array('prompt' => '-- Select one --')); ?>
		<?php echo $form->error($model,'banns_licence'); ?>
	</span>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'minister'); ?>
		<?php echo $form->textField($model,'minister',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'minister'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'witness1'); ?>
		<?php echo $form->textField($model,'witness1',array('size'=>60,'maxlength'=>75)); ?>
		<?php echo $form->error($model,'witness1'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'witness2'); ?>
		<?php echo $form->textField($model,'witness2',array('size'=>60,'maxlength'=>75)); ?>
		<?php echo $form->error($model,'witness2'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'remarks'); ?>
		<?php echo $form->textField($model,'remarks',array('size'=>60,'maxlength'=>75)); ?>
		<?php echo $form->error($model,'remarks'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

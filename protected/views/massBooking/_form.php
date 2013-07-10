<?php
/* @var $this MassBookingController */
/* @var $model MassBooking */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'mass-booking-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,"mass_dt"); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'attribute' => "mass_dt",
			'options'	=> array(
				'dateFormat' => 'yy-mm-dd',
				'changeYear' => true
			),
			'htmlOptions' => array(
				'size' => '10',         // textField size
				'maxlength' => '10',    // textField maxlength
				'onChange' => CHtml::ajax(array(
					'id' => 'MassBooking_mass_dt',
					'type'=>'POST',
					'url' => Yii::app()->createUrl('/massBooking/masses'),
					'update' => '#MassBooking_mass_id',
					'data'=> 'js:jQuery(this).serialize()',
				)),
			),
		)); ?>
		<?php echo $form->error($model,"mass_dt"); ?>
	</div>

	<div id="mass-id-div" class="row">
		<?php echo $form->labelEx($model,'mass_id'); ?>
		<?php echo $form->dropDownList($model,'mass_id',array('prompt' => '--- Select ---')); ?>
		<?php echo $form->error($model,'mass_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'booked_by'); ?>
		<?php echo $form->textField($model,'booked_by',array('size'=>60,'maxlength'=>99)); ?>
		<?php echo $form->error($model,'booked_by'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'intention'); ?>
		<?php echo $form->textField($model,'intention',array('size'=>60,'maxlength'=>99)); ?>
		<?php echo $form->error($model,'intention'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

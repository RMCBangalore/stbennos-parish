<?php
#
# This file is part of Alive Parish Software
#
# Alive Parish - software to manage tomorrow's parish
# Copyright (C) 2013  Redemptorist Media Center
#
# Alive Parish Software is free software: you can redistribute it
# and/or modify it under the terms of the GNU General Public License as
# published by the Free Software Foundation, either version 3 of the
# License, or (at your option) any later version.
#
# Alive Parish Software is distributed in the hope that it will
# be useful, but WITHOUT ANY WARRANTY; without even the implied warranty
# of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
#
# You should have received a copy of the GNU General Public License
# along with this program.  If not, see <http://www.gnu.org/licenses/>.
#
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
	<span class="leftHalf">
		<?php echo $form->labelEx($model,"mass_dt"); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'attribute' => "mass_dt",
			'options'	=> array(
				'dateFormat' => Yii::app()->params['dateFmtDP'],
				'yearRange'  => '1900:c+10',
				'minDate'    => 0,
				'changeYear' => true
			),
			'htmlOptions' => array(
				'value' => $mass_dt,
				'size' => '10',         // textField size
				'maxlength' => '10',    // textField maxlength
				'onChange' => 
					CHtml::ajax(array(
						'id' => 'MassBooking_mass_dt',
						'type'=>'POST',
						'url' => Yii::app()->createUrl('/massBooking/masses'),
						'update' => '#MassBooking_mass_id',
						'data'=> 'js:jQuery(this).serialize()',
					)) .
					CHtml::ajax(array(
						'id' => 'MassBooking_mass_dt',
						'type'=>'POST',
						'url' => Yii::app()->createUrl('/massBooking/massAmt'),
						'update' => '#amount',
						'data'=> 'js:jQuery(this).serialize()',
					))
			),
		)); ?>
		<?php echo $form->error($model,"mass_dt"); ?>
		<span id="amount"></span>
	</span>
	<span id="mass-id-div" class="rightHalf">
		<?php echo $form->labelEx($model,'mass_id'); ?>
		<?php echo $form->dropDownList($model,'mass_id',array('prompt' => '--- Select ---')); ?>
		<?php echo $form->error($model,'mass_id'); ?>
	</span>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'booked_by'); ?>
		<?php echo $form->textField($model,'booked_by',array('size'=>60,'maxlength'=>99)); ?>
		<?php echo $form->error($model,'booked_by'); ?>
	</div>

	<div class="row">
	<td>
	</td><td>
		<?php echo $form->labelEx($model,'intention'); ?>
		<?php echo $form->dropDownList($model,'type',array('R.I.P'=>'R.I.P','Anniversary'=>'Anniversary','Thanksgiving'=>'Thanksgiving')); ?>
		<?php echo $form->error($model,'type'); ?>
		<?php echo $form->textField($model,'intention',array('size'=>50,'maxlength'=>99)); ?>
		<?php echo $form->error($model,'intention'); ?>
	</td>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<?php if (strlen($mass_dt) > 0) {
	Yii::app()->clientScript->registerScript('getMasses', "
jQuery.ajax( {
	'id':'MassBooking_mass_dt',
	'type':'POST',
	'url': '" . Yii::app()->createUrl('/massBooking/masses') . "',
	'data': { 'MassBooking[mass_dt]' : '$mass_dt' },
	'cache':false,
	'success':function(html){
		jQuery('#MassBooking_mass_id').html(html)
		$('#MassBooking_mass_id').val($mass_id);
	}
} );
jQuery.ajax( {
	'id':'MassBooking_mass_dt',
	'type':'POST',
	'url': '" . Yii::app()->createUrl('/massBooking/massAmt') . "',
	'data': { 'MassBooking[mass_dt]' : '$mass_dt' },
	'cache':false,
	'success':function(html){
		jQuery('#amount').html(html)
	}
} );
");
} ?>

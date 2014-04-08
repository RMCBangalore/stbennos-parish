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
/* @var $this BaptismRecordsController */
/* @var $model BaptismRecord */
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
		<?php echo $form->label($model,'dob'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'attribute' => "dob",
			'options'	=> array(
				'dateFormat' => Yii::app()->params['dateFmtDP'],
				'yearRange'  => '1900:c+10',
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
			'attribute' => "baptism_dt",
			'options'	=> array(
				'dateFormat' => Yii::app()->params['dateFmtDP'],
				'yearRange'  => '1900:c+10',
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
		<?php echo $form->textField($model,'baptism_place',array('size'=>30,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sex'); ?>
		<?php echo $form->dropDownList($model,"sex",FieldNames::values('sex'),array('prompt' => '--- Select ---')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fathers_name'); ?>
		<?php echo $form->textField($model,'fathers_name',array('size'=>60,'maxlength'=>75)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'mothers_name'); ?>
		<?php echo $form->textField($model,'mothers_name',array('size'=>60,'maxlength'=>75)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'mother_tongue'); ?>
		<?php echo $form->textField($model,'mother_tongue',array('size'=>25,'maxlength'=>25)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'residence'); ?>
		<?php echo $form->textField($model,'residence',array('size'=>25,'maxlength'=>25)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'godfathers_name'); ?>
		<?php echo $form->textField($model,'godfathers_name',array('size'=>60,'maxlength'=>75)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'godmothers_name'); ?>
		<?php echo $form->textField($model,'godmothers_name',array('size'=>60,'maxlength'=>75)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'minister'); ?>
		<?php echo $form->textField($model,'minister',array('size'=>60,'maxlength'=>75)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search', array('id' => 'submit-button')); ?>
		<?php echo CHtml::submitButton('Excel Export', array('name' => 'export')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->

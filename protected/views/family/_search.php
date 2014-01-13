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
/* @var $this FamilyController */
/* @var $model Families */
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
	<span class="leftHalf">
		<?php echo $form->label($model,'fid'); ?>
		<?php echo $form->textField($model,'fid',array('size'=>11,'maxlength'=>11)); ?>
	</span>
	<span class="rightHalf sub_till">
		<?php echo CHtml::label('Subscription', 'sub_till_mth'); ?>
		<?php echo CHtml::dropDownList('paid','',array(0=>'Paid till',1=>'Due from'),array('id'=>'sub_paid')); ?>
		<?php echo CHtml::textField('sub_till_mth', '', array('id' => 'sub_till_mth','size'=>8)); ?>
		<?php echo $form->hiddenField($model,'sub_till'); ?>
	</span>
	</div>

	<div class="row">
		<?php echo $form->label($model,'addr_nm'); ?>
		<?php echo $form->textField($model,'addr_nm',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'addr_stt'); ?>
		<?php echo $form->textField($model,'addr_stt',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'addr_area'); ?>
		<?php echo $form->textField($model,'addr_area',array('size'=>25,'maxlength'=>25)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'addr_pin'); ?>
		<?php echo $form->textField($model,'addr_pin',array('size'=>7,'maxlength'=>7)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'phone'); ?>
		<?php echo $form->textField($model,'phone',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'mobile'); ?>
		<?php echo $form->textField($model,'mobile',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'zone'); ?>
		<?php echo $form->dropDownList($model,'zone',FieldNames::values('zones'),array('prompt'=>'--- Select ---')); ?>
	</div>

	<div class="row">
	<span class="leftHalf">
		<?php echo $form->label($model,'reg_date'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
				'model' => $model,
				'attribute' => "reg_date",
				'options'       => array(
						'dateFormat' => Yii::app()->params['dateFmtDP'],
						'yearRange'  => '1900:c+10',
						'changeYear' => true,
						'maxDate'		=> 0,
				),
				'htmlOptions' => array(
						'size' => '10',         // textField size
						'maxlength' => '10',    // textField maxlength
				),
		)); ?>
	</span>
	<span class="rightHalf">
		<?php echo $form->label($model, 'reg_yrs'); ?>
		<?php echo $form->textField($model,'reg_yrs',array('size'=>4,'maxlength'=>8)); ?>
	</span>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bpl_card'); ?>
		<?php echo $form->dropDownList($model,'bpl_card',array(0=>'No',1=>'Yes'),array('prompt'=>' -- Select -- ')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'marriage_church'); ?>
		<?php echo $form->textField($model,'marriage_church',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
	<span class="leftHalf">
		<?php echo $form->label($model,'marriage_date'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
				'model' => $model,
				'attribute' => "marriage_date",
				'options'       => array(
						'dateFormat' => Yii::app()->params['dateFmtDP'],
						'yearRange'  => '1900:c+10',
						'changeYear' => true,
						'maxDate'		=> 0,
				),
				'htmlOptions' => array(
						'size' => '10',         // textField size
						'maxlength' => '10',    // textField maxlength
				),
		)); ?>
	</span>
	<span class="rightHalf">
		<?php echo $form->label($model, 'marriage_yrs'); ?>
		<?php echo $form->textField($model,'marriage_yrs',array('size'=>4,'maxlength'=>8)); ?>
	</span>
	</div>

	<div class="row">
    <span class="leftHalf">
		<?php echo $form->label($model,'marriage_type'); ?>
		<?php echo $form->dropDownList($model,'marriage_type',FieldNames::values('marriage_type'),array('prompt'=>'--- Select ---')); ?>
	</span>

	<span class="rightHalf">
		<?php echo $form->label($model,'marriage_status'); ?>
		<?php echo $form->dropDownList($model,'marriage_status',FieldNames::values('marriage_status'),array('prompt'=>'--- Select ---')); ?>
	</span>
	</div>

	<div class="row">
	<span class="leftHalf">
		<?php echo $form->label($model,'monthly_income'); ?>
		<?php echo $form->textField($model,'monthly_income',array('size'=>15,'maxlength'=>15)); ?>
	</span>
	<span class="rightHalf">
		<?php echo $form->label($model,'disabled'); ?>
		<?php echo $form->dropDownList($model,'disabled',array(0=>'No',1=>'Yes'),array('prompt'=>' -- Select -- ')); ?>
	</span>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search', array('id' => 'submit-button')); ?>
		<?php echo CHtml::submitButton('Excel Export', array('name' => 'export')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->

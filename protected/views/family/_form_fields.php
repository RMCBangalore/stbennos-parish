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

	<div class="row">
	<span class="leftHalf">
		<?php echo $form->labelEx($model,'fid'); ?>
		<?php echo $form->textField($model,'fid',array('size'=>11,'maxlength'=>11)); ?>
		<?php echo $form->error($model,'fid'); ?>
	</span>

	<span class="rightHalf">
		<?php echo $form->labelEx($model,'addr_nm'); ?>
		<?php echo $form->textField($model,'addr_nm',array('size'=>30,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'addr_nm'); ?>
	</span>
	</div>

	<div class="row">
	<span class="leftHalf">
		<?php echo $form->labelEx($model,'addr_stt'); ?>
		<?php echo $form->textField($model,'addr_stt',array('size'=>30,'maxlength'=>75)); ?>
		<?php echo $form->error($model,'addr_stt'); ?>
	</span>

	<span class="rightHalf">
		<?php echo $form->labelEx($model,'addr_area'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
			'model' => $model,
			'attribute' => "addr_area",
			'source' => $ac['areas'],
			'htmlOptions' => array('size'=>25,'maxlength'=>25)
		)); ?>
		<?php echo $form->error($model,'addr_area'); ?>
	</span>
	</div>

	<div class="row">
    <span class="leftHalf">
		<?php echo $form->labelEx($model,'addr_pin'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
			'model' => $model,
			'attribute' => "addr_pin",
			'source' => $ac['pincodes'],
			'htmlOptions' => array('size'=>7,'maxlength'=>7)
		)); ?>
		<?php echo $form->error($model,'addr_pin'); ?>
	</span>

	<span class="rightHalf">
		<?php echo $form->labelEx($model,'house_status'); ?>
		<?php echo $form->dropDownList($model,'house_status',FieldNames::values('house_status'),array('prompt'=>'--- Select ---')); ?>
		<?php echo $form->error($model,'house_status'); ?>
	</span>
	</div>

	<div class="row">
    <span class="leftHalf">
		<?php echo $form->labelEx($model,'phone'); ?>
		<?php echo $form->textField($model,'phone',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'phone'); ?>
	</span>

	<span class="rightHalf">
		<?php echo $form->labelEx($model,'mobile'); ?>
		<?php echo $form->textField($model,'mobile',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'mobile'); ?>
	</span>
	</div>

	<div class="row">
    <span class="leftHalf">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>30,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'email'); ?>
	</span>

	<span class="rightHalf">
		<?php echo $form->labelEx($model,'remarks'); ?>
		<?php echo $form->textField($model,'remarks',array('size'=>30,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'remarks'); ?>
	</span>
	</div>

	<div class="row">
    <span class="leftHalf">
		<?php echo $form->labelEx($model,'zone'); ?>
		<?php echo $form->dropDownList($model,'zone',FieldNames::values('zones'),array('prompt'=>'--- Select ---')); ?>
		<?php echo $form->error($model,'zone'); ?>
	</span>

	<span class="rightHalf">
		<?php echo $form->labelEx($model,'reg_date'); ?>
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
		<?php echo $form->error($model,'reg_date'); ?>
	</span>
	</div>

	<div class="row">
    <span class="leftHalf">
		<?php echo $form->labelEx($model,'bpl_card'); ?>
		<?php echo $form->dropDownList($model,'bpl_card',array(0=>'No',1=>'Yes')); ?>
		<?php echo $form->error($model,'bpl_card'); ?>
	</span>

	<span class="rightHalf">
		<?php echo $form->labelEx($model,'marriage_church'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
			'model' => $model,
			'attribute' => "marriage_church",
			'source' => $ac['churches'],
			'htmlOptions' => array('size'=>30,'maxlength'=>50)
		)); ?>
		<?php echo $form->error($model,'marriage_church'); ?>
	</span>
	</div>

	<div class="row">
    <span class="leftHalf">
		<?php echo $form->labelEx($model,'marriage_date'); ?>
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

		<?php echo $form->error($model,'marriage_date'); ?>
	</span>

	<span class="rightHalf">
		<?php echo $form->labelEx($model,'marriage_type'); ?>
		<?php echo $form->dropDownList($model,'marriage_type',FieldNames::values('marriage_type'),array('prompt'=>'--- Select ---')); ?>
		<?php echo $form->error($model,'marriage_type'); ?>
	</span>
	</div>

	<div class="row">
    <span class="leftHalf">
		<?php echo $form->labelEx($model,'marriage_status'); ?>
		<?php echo $form->dropDownList($model,'marriage_status',FieldNames::values('marriage_status'),array('prompt'=>'--- Select ---')); ?>
		<?php echo $form->error($model,'marriage_status'); ?>
	</span>

	<span class="rightHalf">
		<?php echo $form->labelEx($model,'monthly_income'); ?>
		<?php echo $form->dropDownList($model,'monthly_income',FieldNames::values('monthly_household_income'),array('prompt'=>'--- Select ---')); ?>
		<?php echo $form->error($model,'monthly_income'); ?>
	</span>
	</div>

	<?php /* if (!$model->isNewRecord): ?>
	<div class="row">
	<span class="leftHalf">
		<?php echo $form->labelEx($model,'disabled'); ?>
		<?php echo $form->dropDownList($model,'disabled',array(0=>'No',1=>'Yes')); ?>
	</span>
	<span class="rightHalf">
		<?php echo $form->labelEx($model,'leaving_date'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'attribute' => "leaving_date",
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
		<?php echo $form->error($model,'leaving_date'); ?>
	</span>
	</div>
	<?php endif */ ?>


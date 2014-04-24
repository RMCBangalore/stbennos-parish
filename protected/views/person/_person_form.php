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
/* @var $this PersonController */
/* @var $model People */
/* @var $form CActiveForm */
?>

	<?php echo $form->hiddenField($model,"[$person]id"); ?>

	<div class="row">
	<span class="leftHalf">
		<?php echo $form->labelEx($model,"[$person]fname"); ?>
		<?php echo $form->textField($model,"[$person]fname",array('size'=>30,'maxlength'=>50)); ?>
		<?php echo $form->error($model,"[$person]fname"); ?>
	</span>
	<span class="rightHalf">
		<?php echo $form->labelEx($model,"[$person]lname"); ?>
		<?php echo $form->textField($model,"[$person]lname",array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,"[$person]lname"); ?>
	</span>
	</div>

	<div class="row">
	<span class="leftHalf">
		<?php echo $form->labelEx($model,"[$person]sex"); ?>
		<?php echo $form->dropDownList($model,"[$person]sex",FieldNames::values('sex'),array('prompt' => '--- Select ---')); ?>
		<?php echo $form->error($model,"[$person]sex"); ?>
	</span>
	<span class="rightHalf">
		<?php echo $form->labelEx($model,"[$person]dob"); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'attribute' => "[$person]dob",
			'options'	=> array(
				'dateFormat' => Yii::app()->params['dateFmtDP'],
				'yearRange'  => '1900:c+10',
				'maxDate'	=> 0,
				'changeYear' => true
			),
			'htmlOptions' => array(
				'size' => '10',         // textField size
				'maxlength' => '10',    // textField maxlength
			),
		)); ?>
		<?php echo $form->error($model,"[$person]dob"); ?>
	</span>
	</div>

	<div class="row">
	<span class="leftHalf">
		<?php echo $form->labelEx($model,"[$person]mobile"); ?>
		<?php echo $form->textField($model,"[$person]mobile",array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,"[$person]mobile"); ?>
	</span>
	<span class="rightHalf">
		<?php echo $form->labelEx($model,"[$person]email"); ?>
		<?php echo $form->textField($model,"[$person]email",array('size'=>30,'maxlength'=>50)); ?>
		<?php echo $form->error($model,"[$person]email"); ?>
	</span>
	</div>

	<div class="row">
	<span class="leftHalf">
		<?php echo $form->labelEx($model,"[$person]domicile_status"); ?>
		<?php echo $form->dropDownList($model,"[$person]domicile_status",FieldNames::values('domicile_status')); ?>
		<?php echo $form->error($model,"[$person]domicile_status"); ?>
	</span>
	<span class="rightHalf">
		<?php echo $form->labelEx($model,"[$person]education"); ?>
		<?php echo $form->dropDownList($model,"[$person]education",FieldNames::values('education')); ?>
		<?php echo $form->error($model,"[$person]education"); ?>
	</span>
	</div>

	<div class="row">
	<span class="leftHalf">
		<?php echo $form->labelEx($model,"[$person]profession"); ?>
		<?php $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
			'model' => $model,
			'attribute' => "[$person]profession",
			'source' => $ac['professions'],
			'htmlOptions' => array('size'=>25,'maxlength'=>25))); ?>
		<?php echo $form->error($model,"[$person]profession"); ?>
	</span>
	<span class="rightHalf">
		<?php echo $form->labelEx($model,"[$person]occupation"); ?>
		<?php $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
			'model' => $model,
			'attribute' => "[$person]occupation",
			'source' => $ac['occupations'],
			'htmlOptions' => array('size'=>25,'maxlength'=>25))); ?>
		<?php echo $form->error($model,"[$person]occupation"); ?>
	</span>
	</div>

	<div class="row">
	<span class="leftHalf">
		<?php echo $form->labelEx($model,"[$person]special_skill"); ?>
		<?php $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
			'model' => $model,
			'attribute' => "[$person]special_skill",
			'source' => $ac['special_skills'],
			'htmlOptions' => array('size'=>25,'maxlength'=>25))); ?>
		<?php echo $form->error($model,"[$person]special_skill"); ?>
	</span>
	<span class="rightHalf">
		<?php echo $form->labelEx($model,"[$person]blood_group"); ?>
		<?php echo $form->dropDownList($model,"[$person]blood_group",FieldNames::values('blood_group'),array('prompt'=>'-Select-')); ?>
		<?php echo $form->error($model,"[$person]blood_group"); ?>
	</span>
	</div>

	<div class="row">
	<span class="leftHalf">
		<?php echo $form->labelEx($model,"[$person]voter_id"); ?>
		<?php echo $form->textField($model,"[$person]voter_id",array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,"[$person]voter_id"); ?>
	</span>
	<span class="rightHalf">
		<?php echo $form->labelEx($model,"[$person]aadhar_no"); ?>
		<?php echo $form->textField($model,"[$person]aadhar_no",array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,"[$person]aadhar_no"); ?>
	</span>
	</div>

	<div class="row">
	<span class="leftHalf">
		<?php echo $form->labelEx($model,"[$person]lang_pri"); ?>
		<?php echo $form->dropDownList($model,"[$person]lang_pri",FieldNames::values('languages')); ?>
		<?php echo $form->error($model,"[$person]lang_pri"); ?>
	</span>
	<span class="rightHalf">
		<?php echo $form->labelEx($model,"[$person]lang_lit"); ?>
		<?php echo $form->dropDownList($model,"[$person]lang_lit",FieldNames::values('languages'),array('prompt' => '--- Select ---')); ?>
		<?php echo $form->error($model,"[$person]lang_lit"); ?>
	</span>
	</div>

	<div class="row">
	<span class="leftHalf">
		<?php echo $form->labelEx($model,"[$person]lang_edu"); ?>
		<?php echo $form->dropDownList($model,"[$person]lang_edu",FieldNames::values('languages')); ?>
		<?php echo $form->error($model,"[$person]lang_edu"); ?>
	</span>
	<span class="rightHalf">
		<?php echo $form->labelEx($model,"[$person]rite"); ?>
		<?php echo $form->dropDownList($model,"[$person]rite",FieldNames::values('rite'),array('prompt' => '--- Select ---')); ?>
		<?php echo $form->error($model,"[$person]rite"); ?>
	</span>
	</div>

	<div class="row">
	<span class="leftHalf">
		<?php echo $form->labelEx($model,"[$person]baptism_dt"); ?>
		<?php $pstr = preg_replace('/\]\[/', '_', $person);
		$this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'attribute' => "[$person]baptism_dt",
			'options'	=> array(
				'dateFormat' => Yii::app()->params['dateFmtDP'],
				'yearRange'  => '1900:c+10',
				'changeYear' => true,
				'maxDate'	=> 0,
				'beforeShowDay' => 'js:function(dt) {
					return new Array(dt > $.datepicker.parseDate("'
						.Yii::app()->params['dateFmtDP'].'", $("#People_' . $pstr . '_dob").val()),
					"", "Cannot be before the date of birth"); }'
			),
			'htmlOptions' => array(
				'size' => '10',         // textField size
				'maxlength' => '10',    // textField maxlength
			),
		)); ?>
		<?php echo $form->error($model,"[$person]baptism_dt"); ?>
	</span>
	<span class="rightHalf">
		<?php echo $form->labelEx($model,"[$person]baptism_church"); ?>
		<?php $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
			'model' => $model,
			'attribute' => "[$person]baptism_church",
			'source' => $ac['churches'],
			'htmlOptions' => array('size'=>25,'maxlength'=>50))); ?>
		<?php echo $form->error($model,"[$person]baptism_church"); ?>
	</span>
	</div>

	<div class="row">
	<span class="leftHalf">
		<?php echo $form->labelEx($model,"[$person]baptism_place"); ?>
		<?php $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
			'model' => $model,
			'attribute' => "[$person]baptism_place",
			'source' => $ac['baptism_places'],
			'htmlOptions' => array('size'=>15,'maxlength'=>15))); ?>
		<?php echo $form->error($model,"[$person]baptism_place"); ?>
	</span>
	<span class="rightHalf">
		<?php echo $form->labelEx($model,"[$person]god_parents"); ?>
		<?php echo $form->textField($model,"[$person]god_parents",array('size'=>30,'maxlength'=>50)); ?>
		<?php echo $form->error($model,"[$person]god_parents"); ?>
	</span>
	</div>

	<div class="row">
	<span class="leftHalf">
		<?php echo $form->labelEx($model,"[$person]first_comm_dt"); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'attribute' => "[$person]first_comm_dt",
			'options'	=> array(
				'dateFormat' => Yii::app()->params['dateFmtDP'],
				'yearRange'  => '1900:c+10',
				'maxDate'	=> 0,
				'beforeShowDay' => 'js:function(dt) {
					return new Array(dt > $.datepicker.parseDate("'
						.Yii::app()->params['dateFmtDP'].'", $("#People_' . $pstr . '_baptism_dt").val()),
					"", "Cannot be before the baptism date"); }',
				'changeYear' => true
			),
			'htmlOptions' => array(
				'size' => '10',         // textField size
				'maxlength' => '10',    // textField maxlength
			),
		)); ?>
		<?php echo $form->error($model,"[$person]first_comm_dt"); ?>
	</span>
	<span class="rightHalf">
		<?php echo $form->labelEx($model,"[$person]confirmation_dt"); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'attribute' => "[$person]confirmation_dt",
			'options'	=> array(
				'dateFormat' => Yii::app()->params['dateFmtDP'],
				'yearRange'  => '1900:c+10',
				'maxDate'	=> 0,
				'beforeShowDay' => 'js:function(dt) {
					return new Array(dt > $.datepicker.parseDate("'
						.Yii::app()->params['dateFmtDP'].'", $("#People_' . $pstr . '_baptism_dt").val()),
					"", "Cannot be before the baptism date"); }',
				'changeYear' => true
			),
			'htmlOptions' => array(
				'size' => '10',         // textField size
				'maxlength' => '10',    // textField maxlength
			),
		)); ?>
		<?php echo $form->error($model,"[$person]confirmation_dt"); ?>
	</span>
	</div>

	<div class="row">
	<span class="leftHalf">
		<?php echo $form->labelEx($model,"[$person]marriage_dt"); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'attribute' => "[$person]marriage_dt",
			'options'	=> array(
				'dateFormat' => Yii::app()->params['dateFmtDP'],
				'yearRange'  => '1900:c+10',
				'maxDate'	=> 0,
				'beforeShowDay' => 'js:function(dt) {
					return new Array(dt > $.datepicker.parseDate("'
						.Yii::app()->params['dateFmtDP']
						.'", $("#People_' . $pstr . '_confirmation_dt").val()),
					"", "Cannot be before the confirmation date"); }',
				'changeYear' => true
			),
			'htmlOptions' => array(
				'size' => '10',         // textField size
				'maxlength' => '10',    // textField maxlength
			),
		)); ?>
		<?php echo $form->error($model,"[$person]marriage_dt"); ?>
	</span>
	<span class="rightHalf">
		<?php echo $form->labelEx($model,"[$person]death_dt"); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'attribute' => "[$person]death_dt",
			'options'	=> array(
				'dateFormat' => Yii::app()->params['dateFmtDP'],
				'yearRange'  => '1900:c+10',
				'maxDate'	=> 0,
				'beforeShowDay' => 'js:function(dt) {
					return new Array(dt > $.datepicker.parseDate("'
						.Yii::app()->params['dateFmtDP']
						.'", $("#People_' . $pstr . '_confirmation_dt").val()),
					"", "Cannot be before the confirmation date"); }',
				'changeYear' => true
			),
			'htmlOptions' => array(
				'size' => '10',         // textField size
				'maxlength' => '10',    // textField maxlength
			),
		)); ?>
		<?php echo $form->error($model,"[$person]death_dt"); ?>
	</span>
	</div>

	<div class="row">
	<span class="leftHalf">
		<?php echo $form->labelEx($model,"[$person]cemetery_church"); ?>
		<?php $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
			'model' => $model,
			'attribute' => "[$person]cemetery_church",
			'source' => $ac['cemetery_churches'],
			'htmlOptions' => array('size'=>25,'maxlength'=>25))); ?>
		<?php echo $form->error($model,"[$person]cemetery_church"); ?>
	</span>
	<span class="rightHalf">
		<?php echo $form->labelEx($model,"[$person]remarks"); ?>
		<?php echo $form->textField($model,"[$person]remarks",array('size'=>30,'maxlength'=>50)); ?>
		<?php echo $form->error($model,"[$person]remarks"); ?>
	</span>
	</div>


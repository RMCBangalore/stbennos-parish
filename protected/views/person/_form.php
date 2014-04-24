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

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'people-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
	<span class="leftHalf">
		<?php echo $form->labelEx($model,'fname'); ?>
		<?php echo $form->textField($model,'fname',array('size'=>30,'maxlength'=>50)); ?>
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
		<?php echo $form->labelEx($model,'sex'); ?>
		<?php echo $form->dropDownList($model,'sex',FieldNames::values('sex'),array('prompt' => '--- Select ---')); ?>
		<?php echo $form->error($model,'sex'); ?>
	</span>
	<span class="rightHalf">
		<?php echo $form->labelEx($model,'dob'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'attribute' => 'dob',
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
		<?php echo $form->error($model,'dob'); ?>
	</span>
	</div>

	<div class="row">
	<span class="leftHalf">
		<?php echo $form->labelEx($model,'mobile'); ?>
		<?php echo $form->textField($model,'mobile',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'mobile'); ?>
	</span>
	<span class="rightHalf">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>30,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'email'); ?>
	</span>
	</div>

	<div class="row">
	<span class="leftHalf">
		<?php echo $form->labelEx($model,'domicile_status'); ?>
		<?php echo $form->dropDownList($model,'domicile_status',FieldNames::values('domicile_status')); ?>
		<?php echo $form->error($model,'domicile_status'); ?>
	</span>
	<span class="rightHalf">
		<?php echo $form->labelEx($model,'education'); ?>
		<?php echo $form->dropDownList($model,'education',FieldNames::values('education')); ?>
		<?php echo $form->error($model,'education'); ?>
	</span>
	</div>

	<div class="row">
	<span class="leftHalf">
		<?php echo $form->labelEx($model,'profession'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
			'model' => $model,
			'attribute' => 'profession',
			'source' => $ac['professions'],
			'htmlOptions' => array('size'=>25,'maxlength'=>25))); ?>
		<?php echo $form->error($model,'profession'); ?>
	</span>
	<span class="rightHalf">
		<?php echo $form->labelEx($model,'occupation'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
			'model' => $model,
			'attribute' => 'occupation',
			'source' => $ac['occupations'],
			'htmlOptions' => array('size'=>25,'maxlength'=>25))); ?>
		<?php echo $form->error($model,'occupation'); ?>
	</span>
	</div>

	<div class="row">
	<span class="leftHalf">
		<?php echo $form->labelEx($model,"special_skill"); ?>
		<?php $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
			'model' => $model,
			'attribute' => 'special_skill',
			'source' => $ac['special_skills'],
			'htmlOptions' => array('size'=>25,'maxlength'=>25))); ?>
		<?php echo $form->error($model,"special_skill"); ?>
	</span>
	<span class="rightHalf">
		<?php echo $form->labelEx($model,"remarks"); ?>
		<?php echo $form->textField($model,"remarks",array('size'=>30,'maxlength'=>50)); ?>
		<?php echo $form->error($model,"remarks"); ?>
	</span>
	</div>

	<div class="row">
	<span class="leftHalf">
		<?php echo $form->labelEx($model,'lang_pri'); ?>
		<?php echo $form->dropDownList($model,'lang_pri',FieldNames::values('languages')); ?>
		<?php echo $form->error($model,'lang_pri'); ?>
	</span>
	<span class="rightHalf">
		<?php echo $form->labelEx($model,'lang_lit'); ?>
		<?php echo $form->dropDownList($model,'lang_lit',FieldNames::values('languages')); ?>
		<?php echo $form->error($model,'lang_lit'); ?>
	</span>
	</div>

	<div class="row">
	<span class="leftHalf">
		<?php echo $form->labelEx($model,'lang_edu'); ?>
		<?php echo $form->dropDownList($model,'lang_edu',FieldNames::values('languages')); ?>
		<?php echo $form->error($model,'lang_edu'); ?>
	</span>
	<span class="rightHalf">
		<?php echo $form->labelEx($model,'rite'); ?>
		<?php echo $form->dropDownList($model,'rite',FieldNames::values('rite'),array('prompt' => '--- Select ---')); ?>
		<?php echo $form->error($model,'rite'); ?>
	</span>
	</div>

	<div class="row">
	<span class="leftHalf">
		<?php echo $form->labelEx($model,'baptism_dt'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'attribute' => 'baptism_dt',
			'options'	=> array(
				'dateFormat' => Yii::app()->params['dateFmtDP'],
				'yearRange'  => '1900:c+10',
				'changeYear' => true,
				'maxDate'	=> 0,
				'beforeShowDay' => 'js:function(dt) {
					return new Array(dt >= $.datepicker.parseDate("'.Yii::app()->params['dateFmtDP'].'", $("#People_dob").val()),
					"", "Cannot be before date of birth"); }'
			),
			'htmlOptions' => array(
				'size' => '10',         // textField size
				'maxlength' => '10',    // textField maxlength
			),
		)); ?>
		<?php echo $form->error($model,'baptism_dt'); ?>
	</span>
	<span class="rightHalf">
		<?php echo $form->labelEx($model,'baptism_church'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
			'model' => $model,
			'attribute' => 'baptism_church',
			'source' => $ac['churches'],
			'htmlOptions' => array('size'=>25,'maxlength'=>50))); ?>
		<?php echo $form->error($model,'baptism_church'); ?>
	</span>
	</div>

	<div class="row">
	<span class="leftHalf">
		<?php echo $form->labelEx($model,'baptism_place'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
			'model' => $model,
			'attribute' => 'baptism_place',
			'source' => $ac['baptism_places'],
			'htmlOptions' => array('size'=>15,'maxlength'=>15))); ?>
		<?php echo $form->error($model,'baptism_place'); ?>
	</span>
	<span class="rightHalf">
		<?php echo $form->labelEx($model,'god_parents'); ?>
		<?php echo $form->textField($model,'god_parents',array('size'=>30,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'god_parents'); ?>
	</span>
	</div>

	<div class="row">
	<span class="leftHalf">
		<?php echo $form->labelEx($model,'first_comm_dt'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'attribute' => 'first_comm_dt',
			'options'	=> array(
				'dateFormat' => Yii::app()->params['dateFmtDP'],
				'yearRange'  => '1900:c+10',
				'maxDate'	=> 0,
				'beforeShowDay' => 'js:function(dt) {
					return new Array(dt >= $.datepicker.parseDate("'.Yii::app()->params['dateFmtDP'].'", $("#People_baptism_dt").val()),
					"", "Cannot be before baptism date"); }',
				'changeYear' => true
			),
			'htmlOptions' => array(
				'size' => '10',         // textField size
				'maxlength' => '10',    // textField maxlength
			),
		)); ?>
		<?php echo $form->error($model,'first_comm_dt'); ?>
	</span>
	<span class="rightHalf">
		<?php echo $form->labelEx($model,'confirmation_dt'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'attribute' => 'confirmation_dt',
			'options'	=> array(
				'dateFormat' => Yii::app()->params['dateFmtDP'],
				'yearRange'  => '1900:c+10',
				'maxDate'	=> 0,
				'beforeShowDay' => 'js:function(dt) {
					return new Array(dt >= $.datepicker.parseDate("'.Yii::app()->params['dateFmtDP'].'", $("#People_baptism_dt").val()),
					"", "Cannot be before baptism date"); }',
				'changeYear' => true
			),
			'htmlOptions' => array(
				'size' => '10',         // textField size
				'maxlength' => '10',    // textField maxlength
			),
		)); ?>
		<?php echo $form->error($model,'confirmation_dt'); ?>
	</span>
	</div>

	<div class="row">
	<span class="leftHalf">
		<?php echo $form->labelEx($model,'marriage_dt'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'attribute' => 'marriage_dt',
			'options'	=> array(
				'dateFormat' => Yii::app()->params['dateFmtDP'],
				'yearRange'  => '1900:c+10',
				'maxDate'	=> 0,
				'beforeShowDay' => 'js:function(dt) {
					return new Array(dt >= $.datepicker.parseDate("'.
						Yii::app()->params['dateFmtDP'].'", $("#People_confirmation_dt").val()),
					"", "Cannot be before confirmation date"); }',
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
		<?php echo $form->labelEx($model,"death_dt"); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'attribute' => "death_dt",
			'options'	=> array(
				'dateFormat' => Yii::app()->params['dateFmtDP'],
				'yearRange'  => '1900:c+10',
				'maxDate'	=> 0,
				'beforeShowDay' => 'js:function(dt) {
					return new Array(dt > $.datepicker.parseDate("'.
						Yii::app()->params['dateFmtDP'].'", $("#People_confirmation_dt").val()),
					"", "Cannot be before the confirmation date"); }',
				'changeYear' => true
			),
			'htmlOptions' => array(
				'size' => '10',         // textField size
				'maxlength' => '10',    // textField maxlength
			),
		)); ?>
		<?php echo $form->error($model,"death_dt"); ?>
	</span>
	</div>

	<div class="row">
	<span>
		<?php echo $form->labelEx($model,'cemetery_church'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
			'model' => $model,
			'attribute' => 'cemetery_church',
			'source' => $ac['cemetery_churches'],
			'htmlOptions' => array('size'=>25,'maxlength'=>25))); ?>
		<?php echo $form->error($model,'cemetery_church'); ?>
	</span>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

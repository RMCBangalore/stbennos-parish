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
		<?php echo $form->label($model,'mid'); ?>
		<?php echo $form->textField($model,'mid',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fname'); ?>
		<?php echo $form->textField($model,'fname',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'lname'); ?>
		<?php echo $form->textField($model,'lname',array('size'=>25,'maxlength'=>25)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sex'); ?>
		<?php echo $form->dropDownList($model,'sex',FieldNames::values('sex'),array('prompt' => '--- Select ---')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'domicile_status'); ?>
		<?php echo $form->dropDownList($model,'domicile_status',FieldNames::values('domicile_status'), array('prompt' => '-- Select --')); ?>
	</div>

	<div class="row">
		<table><tr>
		<td>
		<?php echo $form->label($model,'dob'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'attribute' => 'dob',
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
		</td>
		<td>
		<?php echo $form->label($model, 'age'); ?>
		<?php echo $form->textField($model,'age',array('size'=>4,'maxlength'=>8)); ?>
		</td>
		</tr></table>
	</div>

	<div class="row">
		<?php echo $form->label($model,'education'); ?>
		<?php echo $form->dropDownList($model,'education',FieldNames::values('education'), array('prompt' => '-- Select --')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'profession'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
			'model' => $model,
			'attribute' => 'profession',
			'source' => $ac['professions'],
			'htmlOptions' => array('size'=>25,'maxlength'=>25))); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'occupation'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
			'model' => $model,
			'attribute' => 'occupation',
			'source' => $ac['occupations'],
			'htmlOptions' => array('size'=>25,'maxlength'=>25))); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,"special_skill"); ?>
		<?php $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
			'model' => $model,
			'attribute' => 'special_skill',
			'source' => $ac['special_skills'],
			'htmlOptions' => array('size'=>25,'maxlength'=>25))); ?>
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
		<?php echo $form->label($model,'lang_pri'); ?>
		<?php echo $form->dropDownList($model,'lang_pri',FieldNames::values('languages'), array('prompt' => '-- Select --')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'lang_lit'); ?>
		<?php echo $form->dropDownList($model,'lang_lit',FieldNames::values('languages'), array('prompt' => '-- Select --')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'lang_edu'); ?>
		<?php echo $form->dropDownList($model,'lang_edu',FieldNames::values('languages'), array('prompt' => '-- Select --')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rite'); ?>
		<?php echo $form->dropDownList($model,'rite',FieldNames::values('rite'),array('prompt' => '--- Select ---')); ?>
	</div>

	<div class="row">
		<table><tr>
		<td>
		<?php echo $form->label($model,'baptism_dt'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'attribute' => 'baptism_dt',
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
		</td>
		<td>
		<?php echo $form->label($model, 'baptised_yrs'); ?>
		<?php echo $form->textField($model,'baptised_yrs',array('size'=>4,'maxlength'=>8)); ?>
		</td>
		</tr></table>
	</div>

	<div class="row">
		<?php echo $form->label($model,'baptism_church'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
			'model' => $model,
			'attribute' => 'baptism_church',
			'source' => $ac['churches'],
			'htmlOptions' => array('size'=>25,'maxlength'=>50))); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'baptism_place'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
			'model' => $model,
			'attribute' => 'baptism_place',
			'source' => $ac['baptism_places'],
			'htmlOptions' => array('size'=>15,'maxlength'=>15))); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'god_parents'); ?>
		<?php echo $form->textField($model,'god_parents',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<table><tr>
		<td>
		<?php echo $form->label($model,'first_comm_dt'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'attribute' => "first_comm_dt",
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
		</td><td>
		<?php echo $form->label($model, 'first_comm_yrs'); ?>
		<?php echo $form->textField($model,'first_comm_yrs',array('size'=>4,'maxlength'=>8)); ?>
		</td></tr>
		</table>
	</div>

	<div class="row">
		<table>
		<tr><td>
		<?php echo $form->label($model,'confirmation_dt'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'attribute' => "confirmation_dt",
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
		</td><td>
		<?php echo $form->label($model, 'confirmation_yrs'); ?>
		<?php echo $form->textField($model,'confirmation_yrs',array('size'=>4,'maxlength'=>8)); ?>
		</td></tr>
		</table>
	</div>

	<div class="row">
		<table>
		<tr><td>
		<?php echo $form->label($model,'marriage_dt'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'attribute' => "marriage_dt",
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
		</td><td>
		<?php echo $form->label($model, 'marriage_yrs'); ?>
		<?php echo $form->textField($model,'marriage_yrs',array('size'=>4,'maxlength'=>8)); ?>
		</td></tr>
		</table>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cemetery_church'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
			'model' => $model,
			'attribute' => 'cemetery_church',
			'source' => $ac['cemetery_churches'],
			'htmlOptions' => array('size'=>25,'maxlength'=>25))); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'family_id'); ?>
		<?php echo $form->textField($model,'family_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search', array('id' => 'submit-button')); ?>
		<?php echo CHtml::submitButton('Excel Export', array('name' => 'export')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->

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

$this->widget('application.extensions.fancybox.EFancyBox', array(
    'target'=>'a[rel=gallery]',
	'config'=>array(),
));

Yii::app()->clientScript->registerScript('findMatches', "
function set_find() {
	$('#findMatchForm').submit(function() {
		$.get('" . Yii::app()->createAbsoluteUrl('/person/findMatch') . "', {
			'key': $('#key').val()
		}, function(data) {
			$('#fancybox-content').html(data);
			set_find();
			set_sort();
			set_select();
			set_pager();
		} );
		return false;
	} );
	$('#key').focus();
}
function set_sort() {
	$('a.sort-link').click(function() {
		$.get($(this).attr('href'), function(data) {
			$('#fancybox-content').html(data);
			set_find();
			set_sort();
			set_select();
			set_pager();
		} );
		return false;
	} );
}
function set_pager() {
	$('div.pager li a').click(function() {
		$.get($(this).attr('href'), function(data) {
			$('#fancybox-content').html(data);
			set_find();
			set_sort();
			set_select();
			set_pager();
		} );
		return false;
	} );
}
function update_member(p) {
	$('#BaptismRecord_name').val(p.name).attr('readonly', true);
	if (p.fathers_name) {
		$('#BaptismRecord_fathers_name').val(p.fathers_name).attr('readonly', true);
	}
	if (p.mothers_name) {
		$('#BaptismRecord_mothers_name').val(p.mothers_name).attr('readonly', true);
	}
	$('#BaptismRecord_sex').val(p.sex).attr('readonly', true);
	$('#BaptismRecord_dob').val(p.dob).attr('readonly', true);
	$('#BaptismRecord_dob').datepicker('destroy');
	$('#BaptismRecord_member_id').val(p.id);
}
function set_select() {
	$('#submitMatch').click(function() {
		$.post('" . Yii::app()->createAbsoluteUrl('/person/findMatch') . "', {
			'person': $('input:checked').val()
		}, update_member, 'json' );
		$.fancybox.close();
	} );
}

$('#member_search').fancybox( {
	'onComplete': function() {
		set_find();
		set_sort();
		set_select();
		set_pager();
	}
} );

function set_clear_fields(id) {
	$('#member_clear').click(function() {
		$('#BaptismRecord_name').val('').attr('readonly', false);
		if ($('#BaptismRecord_fathers_name').attr('readonly')) {
			$('#BaptismRecord_fathers_name').val('').attr('readonly', false);
		}
		if ($('#BaptismRecord_mothers_name').attr('readonly')) {
			$('#BaptismRecord_mothers_name').val('').attr('readonly', false);
		}
		$('#BaptismRecord_sex').val('').attr('readonly', true);
		$('#BaptismRecord_dob').val('').attr('readonly', true);
		jQuery('#BaptismRecord_dob').datepicker({'dateFormat':'dd/mm/yy','yearRange':'1900:c+10','changeYear':true});
		$('#BaptismRecord_member_id').val('');
		return false;
	} );
}

set_clear_fields();

");

$baseScriptUrl=Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('zii.widgets.assets'));
Yii::app()->clientScript->registerCssFile($baseScriptUrl.'/gridview/styles.css');  

$pagerScriptUrl=Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('system.web.widgets.pagers'));
Yii::app()->clientScript->registerCssFile($pagerScriptUrl.'/pager.css');  

?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'baptism-record-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name',array('style'=>'display:inline')); ?>
		<?php echo CHtml::link(CHtml::image(Yii::app()->request->baseUrl . '/images/search.png'),
			array('/person/findMatch'), array('id' => 'member_search')); ?>
		<?php echo CHtml::link(CHtml::image(Yii::app()->request->baseUrl . '/images/clear.png'),
			array('#'), array('id' => 'member_clear', 'title' => 'Clear member fields')); ?><br />
		<?php echo $form->textField($model,'name',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->hiddenField($model,'member_id'); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
	<span class="leftHalf">
		<?php echo $form->labelEx($model,'dob'); ?>
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
		<?php echo $form->error($model,'dob'); ?>
	</span>
	<span class="rightHalf">
		<?php echo $form->labelEx($model,'baptism_dt'); ?>
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
		<?php echo $form->error($model,'baptism_dt'); ?>
	</span>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'baptism_place'); ?>
		<?php echo $form->textField($model,'baptism_place',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'baptism_place'); ?>
	</div>

	<div class="row">
	<span class="leftHalf">
		<?php echo $form->labelEx($model,'sex'); ?>
		<?php echo $form->dropDownList($model,"sex",FieldNames::values('sex'),array('prompt' => '--- Select ---')); ?>
		<?php echo $form->error($model,'sex'); ?>
	</span>
	<span class="rightHalf">
		<?php echo $form->labelEx($model,'residence'); ?>
		<?php echo $form->textField($model,'residence',array('size'=>25,'maxlength'=>75)); ?>
		<?php echo $form->error($model,'residence'); ?>
	</span>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'mother_tongue'); ?>
		<?php echo $form->textField($model,'mother_tongue',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'mother_tongue'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fathers_name'); ?>
		<?php echo $form->textField($model,'fathers_name',array('size'=>60,'maxlength'=>75)); ?>
		<?php echo $form->error($model,'fathers_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'mothers_name'); ?>
		<?php echo $form->textField($model,'mothers_name',array('size'=>60,'maxlength'=>75)); ?>
		<?php echo $form->error($model,'mothers_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'godfathers_name'); ?>
		<?php echo $form->textField($model,'godfathers_name',array('size'=>60,'maxlength'=>75)); ?>
		<?php echo $form->error($model,'godfathers_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'godmothers_name'); ?>
		<?php echo $form->textField($model,'godmothers_name',array('size'=>60,'maxlength'=>75)); ?>
		<?php echo $form->error($model,'godmothers_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'minister'); ?>
		<?php echo $form->textField($model,'minister',array('size'=>60,'maxlength'=>75)); ?>
		<?php echo $form->error($model,'minister'); ?>
	</div>

	<div class="row">
	<span class="leftHalf">
		<?php echo $form->labelEx($model,'confirmation_dt'); ?>
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
		<?php echo $form->error($model,'confirmation_dt'); ?>
	</span>
	<span class="rightHalf">
		<?php echo $form->labelEx($model,'marriage_dt'); ?>
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
		<?php echo $form->error($model,'marriage_dt'); ?>
	</span>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'spouse'); ?>
		<?php echo $form->textField($model,'spouse',array('size'=>60,'maxlength'=>75)); ?>
		<?php echo $form->error($model,'spouse'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'remarks'); ?>
		<?php echo $form->textField($model,'remarks',array('size'=>60,'maxlength'=>150)); ?>
		<?php echo $form->error($model,'remarks'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

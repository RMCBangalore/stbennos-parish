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
/* @var $this MarriageRecordsController */
/* @var $model MarriageRecord */
/* @var $form CActiveForm */

$this->widget('application.extensions.fancybox.EFancyBox', array(
    'target'=>'a[rel=gallery]',
	'config'=>array(),
));

Yii::app()->clientScript->registerScript('findMatches', "
function set_find(crit) {
	$('#findMatchForm').submit(function() {
		$.get('" . Yii::app()->createAbsoluteUrl('/person/findMatch') . "', {
			'sex': crit['sex'],
			'key': $('#key').val()
		}, function(data) {
			$('#fancybox-content').html(data);
			set_find(crit);
			set_sort(crit);
			set_select(crit);
			set_pager(crit);
		} );
		return false;
	} );
	$('#key').focus();
}
function set_pager(crit) {
	$('div.pager li a').click(function() {
		$.get($(this).attr('href'), function(data) {
			$('#fancybox-content').html(data);
			set_find(crit);
			set_sort(crit);
			set_select(crit);
			set_pager(crit);
		} );
		return false;
	} );
}
function set_sort(crit) {
	$('a.sort-link').click(function() {
		$.get($(this).attr('href'), function(data) {
			$('#fancybox-content').html(data);
			set_find(crit);
			set_sort(crit);
			set_select(crit);
			set_pager(crit);
		} );
		return false;
	} );
}
function get_cb(id) {
	return function(p) {
		$('#MarriageRecord_'+id+'_name').val(p.name).attr('readonly', true);
		$('#MarriageRecord_'+id+'_dob').datepicker('destroy');
		$('#MarriageRecord_'+id+'_dob').val(p.dob).attr('readonly', true);
		$('#MarriageRecord_'+id+'_baptism_dt').datepicker().datepicker('disable');
		$('#MarriageRecord_'+id+'_baptism_dt').val(p.baptism_dt).attr('readonly', true).attr('disabled', false);
		$('#MarriageRecord_'+id+'_fathers_name').val(p.fathers_name).attr('readonly', true);
		$('#MarriageRecord_'+id+'_mothers_name').val(p.mothers_name).attr('readonly', true);
		$('#MarriageRecord_'+id+'_rank_prof').val(p.rank_prof);
		$('#MarriageRecord_'+id+'_id').val(p.id);
	}
}
function set_select(crit) {
	$('#submitMatch').click(function() {
		$.fancybox.close();
		$.post('" . Yii::app()->createAbsoluteUrl('/person/findMatch') . "', {
			'person': $('input:checked').val()
		}, get_cb(crit['id']), 'json' );
	} );
}

var groom = new Object;
groom['id'] = 'groom';
groom['sex'] = 'male';

$('#groom_search').fancybox( {
	'onComplete': function() {
		set_find(groom);
		set_sort(groom);
		set_select(groom);
		set_pager(groom);
	}
} );

var bride = new Object;
bride['id'] = 'bride';
bride['sex'] = 'female';

$('#bride_search').fancybox( {
	'onComplete': function() {
		set_find(bride);
		set_sort(bride);
		set_select(bride);
		set_pager(bride);
	}
} );

function set_clear_fields(id) {
	$('#' + id + '_clear').click(function() {
		$('#MarriageRecord_'+id+'_name').val('').attr('readonly', false);
		$('#MarriageRecord_'+id+'_dob').val('').attr('readonly', false);
		jQuery('#MarriageRecord_'+id+'_dob').datepicker({'dateFormat':'dd/mm/yy','yearRange':'1900:c+10','changeYear':true});
		$('#MarriageRecord_'+id+'_baptism_dt').val('').attr('readonly', false);
		$('#MarriageRecord_'+id+'_baptism_dt').datepicker('enable');
		$('#MarriageRecord_'+id+'_fathers_name').val('').attr('readonly', false);
		$('#MarriageRecord_'+id+'_mothers_name').val('').attr('readonly', false);
		$('#MarriageRecord_'+id+'_id').val('');
		return false;
	} );
}

set_clear_fields('groom');
set_clear_fields('bride');

");

$baseScriptUrl=Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('zii.widgets.assets'));
Yii::app()->clientScript->registerCssFile($baseScriptUrl.'/gridview/styles.css');  

$pagerScriptUrl=Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('system.web.widgets.pagers'));
Yii::app()->clientScript->registerCssFile($pagerScriptUrl.'/pager.css');  

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
	<table><tr>
	<td>
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
	</td>
	<td>
		<?php echo $form->labelEx($model,'marriage_type'); ?>
		<?php echo $form->dropDownList($model,'marriage_type', FieldNames::values('marriage_type'), array('prompt' => '-- Select one --')); ?>
		<?php echo $form->error($model,'marriage_type'); ?>
	</td>
	<td>
		<?php echo $form->labelEx($model,'banns_licence'); ?>
		<?php echo $form->dropDownList($model,'banns_licence',array('banns' => 'Banns', 'licence' => 'Licence'), array('prompt' => '-- Select one --')); ?>
		<?php echo $form->error($model,'banns_licence'); ?>
	</td>
	</tr></table>
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

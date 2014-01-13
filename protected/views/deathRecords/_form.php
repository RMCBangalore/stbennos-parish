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
/* @var $this DeathRecordsController */
/* @var $model DeathRecord */
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
	$('#DeathRecord_fname').val(p.fname).attr('readonly', true);
	$('#DeathRecord_lname').val(p.lname).attr('readonly', true);
	$('#DeathRecord_dob').val(p.dob);
	$('#DeathRecord_member_id').val(p.id);
	$('#DeathRecord_age').attr('readonly', true);
	$('#DeathRecord_death_dt').change(function() {
		var dob = $.datepicker.parseDate('".Yii::app()->params['dateFmtDP']."', $('#DeathRecord_dob').val());
		var death_dt = $.datepicker.parseDate('".Yii::app()->params['dateFmtDP']."', this.value);
		var age = death_dt.getFullYear() - dob.getFullYear();
		if (death_dt.getMonth() < dob.getMonth() ||
			death_dt.getMonth() == dob.getMonth() && death_dt.getDate() < dob.getDate()) {
			--age;
		}
		$('#DeathRecord_age').val(age);
	} );
	$.fancybox.close();
}
function set_select() {
	$('#submitMatch').click(function() {
		$.fancybox.close();
		$.post('" . Yii::app()->createAbsoluteUrl('/person/findMatch') . "', {
			'person': $('input:checked').val()
		}, update_member, 'json' );
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
		$('#DeathRecord_fname').val('').attr('readonly', false);
		$('#DeathRecord_lname').val('').attr('readonly', false);
		$('#DeathRecord_dob').val('');
		$('#DeathRecord_member_id').val('');
		return false;
	} );
}

set_clear_fields();

");

?>

<style>
span.leftDt, span.leftAge {
	display: block;
	float: left;
}
span.leftDt {
	width: 137px;
}
span.leftAge {
	width: 205px;
}
</style>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'death-record-form',
	'enableAjaxValidation'=>false,
));

$gridScriptUrl=Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('zii.widgets.assets'));
Yii::app()->clientScript->registerCssFile($gridScriptUrl.'/gridview/styles.css');  

$pagerScriptUrl=Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('system.web.widgets.pagers'));
Yii::app()->clientScript->registerCssFile($pagerScriptUrl.'/pager.css');  

?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
	<span class="leftHalf">
		<?php echo $form->labelEx($model,'fname', array('style'=>'display:inline')); ?>
		<?php echo CHtml::link(CHtml::image(Yii::app()->request->baseUrl . '/images/search.png','member search',array('height'=>14,'width'=>'14')),
			array('/person/findMatch'), array('id' => 'member_search')); ?>
		<?php echo CHtml::link(CHtml::image(Yii::app()->request->baseUrl . '/images/clear.png','member clear',array('height'=>14,'width'=>14)),
			array('#'), array('id' => 'member_clear', 'title' => 'Clear member fields')); ?><br />
		<?php echo $form->textField($model,'fname',array('size'=>25,'maxlength'=>50)); ?>
		<?php echo $form->hiddenField($model,'member_id'); ?>
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
	<span class="leftDt">
		<?php echo $form->labelEx($model,'death_dt'); ?>
		<?php echo CHtml::hiddenField('dob', '', array('id'=>'DeathRecord_dob')); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'attribute' => 'death_dt',
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
		<?php echo $form->error($model,'death_dt'); ?>
	</span>
	<span class="leftAge">
		<?php echo $form->labelEx($model,'age'); ?>
		<?php echo $form->textField($model,'age'); ?>
		<?php echo $form->error($model,'age'); ?>
	</span>
	</span>
	<span class="rightHalf">
	<!--table style="margin-bottom:0; width: 350px">
	<tr>
	<td-->
	<!--/td>
	<td-->
		<?php echo $form->labelEx($model,'profession'); ?>
		<?php echo $form->textField($model,'profession',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'profession'); ?>
	<!--/td>
	</tr>
	</table-->
	</span>
	</div>

	<div class="row">
	<span class="leftHalf">
		<?php echo $form->labelEx($model,'sacrament'); ?>
		<?php echo $form->dropDownList($model,'sacrament',array(
				'Confession' => 'Confession',
				'Viaticum' => 'Viaticum',
				'Extreme unction' => 'Extreme unction'),
			array('prompt' => '--- Select ---')); ?>
		<?php echo $form->error($model,'sacrament'); ?>
	</span>
	<span class="rightHalf">
		<?php echo $form->labelEx($model,'community'); ?>
		<?php echo $form->textField($model,'community',array('size'=>25,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'community'); ?>
	</span>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cause'); ?>
		<?php echo $form->textField($model,'cause',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'cause'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'minister'); ?>
		<?php echo $form->textField($model,'minister',array('size'=>60,'maxlength'=>75)); ?>
		<?php echo $form->error($model,'minister'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'residence'); ?>
		<?php echo $form->textField($model,'residence',array('size'=>60,'maxlength'=>75)); ?>
		<?php echo $form->error($model,'residence'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'parents_relatives'); ?>
		<?php echo $form->textField($model,'parents_relatives',array('size'=>60,'maxlength'=>75)); ?>
		<?php echo $form->error($model,'parents_relatives'); ?>
	</div>

	<div class="row">
	<span class="leftHalf">
		<?php echo $form->labelEx($model,'buried_dt'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'attribute' => 'buried_dt',
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
		<?php echo $form->error($model,'buried_dt'); ?>
	</span>
	<span class="rightHalf">
		<?php echo $form->labelEx($model,'burial_place'); ?>
		<?php echo $form->textField($model,'burial_place',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'burial_place'); ?>
	</span>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

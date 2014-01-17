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
/* @var $this BannsRecordsController */
/* @var $model BannsRecord */
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
function set_select(crit) {
	$('#submitMatch').click(function() {
		$.fancybox.close();
		$.post('" . Yii::app()->createAbsoluteUrl('/person/findMatch') . "', {
			'person': $('input:checked').val()
		}, crit['callback'], 'json' );
	} );
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
var groom = new Object;
groom['id'] = 'groom';
groom['sex'] = 'male';
groom['callback'] = function(p) {
	$('#BannsRecord_groom_name').val(p.name).attr('readonly', true);
	$('#BannsRecord_groom_parent').val(p.parents_name).attr('readonly', true);
	$('#BannsRecord_groom_parish').attr('name', 'groom_parish_pub');
	$('#BannsRecord_groom_parish').val('" . Parish::get()->name . "');
	$('#BannsRecord_groom_parish').attr('readonly', true);
	$('#BannsRecord_groom_parish_hid').val(p.id);
	$('#BannsRecord_groom_parish_hid').attr('name', 'BannsRecord[groom_parish]');
};
$('#groom_search').fancybox( {
	'onComplete': function() {
		set_find(groom);
		set_sort(groom);
		set_select(groom);
		set_pager(groom);
	}
} );
$('#groom_clear').click(function() {
	$('#BannsRecord_groom_parish').attr('name', 'BannsRecord[groom_parish]');
	$('#BannsRecord_groom_parish').val('');
	$('#BannsRecord_groom_parish').attr('readonly', false);
	$('#BannsRecord_groom_parish_hid').val('');
	$('#BannsRecord_groom_parish_hid').attr('name', 'groom_parish_hid');
	$('#BannsRecord_groom_name').val('').attr('readonly', false);
	$('#BannsRecord_groom_parent').val('').attr('readonly', false);
	return false;
} );

var bride = new Object;
bride['id'] = 'bride';
bride['sex'] = 'female';
bride['callback'] = function(p) {
	$('#BannsRecord_bride_name').val(p.name).attr('readonly', true);
	$('#BannsRecord_bride_parent').val(p.parents_name).attr('readonly', true);
	$('#BannsRecord_bride_parish').attr('name', 'bride_parish_pub');
	$('#BannsRecord_bride_parish').val('" . Parish::get()->name . "');
	$('#BannsRecord_bride_parish').attr('readonly', true);
	$('#BannsRecord_bride_parish_hid').val(p.id);
	$('#BannsRecord_bride_parish_hid').attr('name', 'BannsRecord[bride_parish]');
};
$('#bride_search').fancybox( {
	'onComplete': function() {
		set_find(bride);
		set_sort(bride);
		set_select(bride);
		set_pager(bride);
	}
} );
$('#bride_clear').click(function() {
	$('#BannsRecord_bride_parish').attr('name', 'BannsRecord[bride_parish]');
	$('#BannsRecord_bride_parish').val('');
	$('#BannsRecord_bride_parish').attr('readonly', false);
	$('#BannsRecord_bride_parish_hid').val('');
	$('#BannsRecord_bride_parish_hid').attr('name', 'bride_parish_hid');
	$('#BannsRecord_bride_name').val('').attr('readonly', false);
	$('#BannsRecord_bride_parent').val('').attr('readonly', false);
	return false;
} );

");

$baseScriptUrl=Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('zii.widgets.assets'));

Yii::app()->clientScript->registerCssFile($baseScriptUrl.'/gridview/styles.css');  

$pagerScriptUrl=Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('system.web.widgets.pagers'));
Yii::app()->clientScript->registerCssFile($pagerScriptUrl.'/pager.css');  

?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'banns-record-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'groom_name',array('style'=>'display:inline')); ?>
		<?php echo CHtml::link(CHtml::image(Yii::app()->request->baseUrl . '/images/search.png'),
			array('/person/findMatch', 'sex' => 'male'), array('id' => 'groom_search', 'title' => 'Find groom from parish records')); ?>
		<?php echo CHtml::link(CHtml::image(Yii::app()->request->baseUrl . '/images/clear.png'),
			array('#'), array('id' => 'groom_clear', 'title' => 'Clear groom fields')); ?><br />
		<?php echo $form->textField($model,'groom_name', array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'groom_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'groom_parish'); ?>
		<?php echo $form->textField($model,'groom_parish',array('size'=>50,'maxlength'=>50,'id'=>'BannsRecord_groom_parish')); ?>
		<?php echo CHtml::hiddenField('groom_parish_hid','',array('id'=>'BannsRecord_groom_parish_hid')); ?>
		<?php echo $form->error($model,'groom_parish'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'groom_parent'); ?>
		<?php echo $form->textField($model,'groom_parent', array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'groom_parent'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'bride_name',array('style'=>'display:inline')); ?>
		<?php echo CHtml::link(CHtml::image(Yii::app()->request->baseUrl . '/images/search.png'),
			array('/person/findMatch', 'sex' => 'female'), array('id' => 'bride_search', 'title' => 'Find bride from parish records')); ?>
		<?php echo CHtml::link(CHtml::image(Yii::app()->request->baseUrl . '/images/clear.png'),
			array('#'), array('id' => 'bride_clear', 'title' => 'Clear bride fields')); ?><br />
		<?php echo $form->textField($model,'bride_name', array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'bride_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'bride_parish'); ?>
		<?php echo $form->textField($model,'bride_parish',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo CHtml::hiddenField('bride_parish_hid','',array('id'=>'BannsRecord_bride_parish_hid')); ?>
		<?php echo $form->error($model,'bride_parish'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'bride_parent'); ?>
		<?php echo $form->textField($model,'bride_parent',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'bride_parent'); ?>
	</div>

	<div class="row">
		<label>Banns Dates</label>
		1st
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'attribute' => 'banns_dt1',
			'options'	=> array(
				'dateFormat' => Yii::app()->params['dateFmtDP'],
				'yearRange'  => '1900:c+10',
			),
			'htmlOptions' => array(
				'size' => '10',         // textField size
				'maxlength' => '10',    // textField maxlength
			),
		)); ?>
		<?php echo $form->error($model,'banns_dt1'); ?>
		2nd
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'attribute' => 'banns_dt2',
			'options'	=> array(
				'dateFormat' => Yii::app()->params['dateFmtDP'],
				'yearRange'  => '1900:c+10',
			),
			'htmlOptions' => array(
				'size' => '10',         // textField size
				'maxlength' => '10',    // textField maxlength
			),
		)); ?>
		<?php echo $form->error($model,'banns_dt2'); ?>
		3rd
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'attribute' => 'banns_dt3',
			'options'	=> array(
				'dateFormat' => Yii::app()->params['dateFmtDP'],
				'yearRange'  => '1900:c+10',
			),
			'htmlOptions' => array(
				'size' => '10',         // textField size
				'maxlength' => '10',    // textField maxlength
			),
		)); ?>
		<?php echo $form->error($model,'banns_dt3'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

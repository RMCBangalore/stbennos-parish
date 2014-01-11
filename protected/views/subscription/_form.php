<?php
#
# This file is part of St. Benno's Parish Software
#
# St. Benno's Parish Software - software to manage tomorrow's parish
# Copyright (C) 2013  Redemptorist Media Center
#
# St. Benno's Parish Software is free software: you can redistribute it
# and/or modify it under the terms of the GNU General Public License as
# published by the Free Software Foundation, either version 3 of the
# License, or (at your option) any later version.
#
# St. Benno's Parish Software is distributed in the hope that it will
# be useful, but WITHOUT ANY WARRANTY; without even the implied warranty
# of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
#
# You should have received a copy of the GNU General Public License
# along with this program.  If not, see <http://www.gnu.org/licenses/>.
#
/* @var $this SubscriptionController */
/* @var $model Subscription */
/* @var $form CActiveForm */

$this->widget('application.extensions.fancybox.EFancyBox', array(
    'target'=>'a[rel=gallery]',
	'config'=>array(),
));

Yii::app()->clientScript->registerScript('findMatches', "
function set_find() {
	$('#findMatchForm').submit(function() {
		$.get('" . Yii::app()->createAbsoluteUrl('/family/findMatch') . "', {
			'key': $('#key').val()
		}, function(data) {
			$('#fancybox-content').html(data);
			set_find();
			set_sort();
			set_select();
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
		} );
		return false;
	} );
}
function update_family(f) {
	$('#Subscription_family_head').val(f.head_name);
	$('#Subscription_family_id').val(f.id);
	$.get('" . Yii::app()->createUrl('/subscription/tillDate') . "?family=' + f.id, function(data) {
		$('#spn_till_month').html(data);
		$('#Subscription_till').attr('disabled', false);
	} );
	$.fancybox.close();
}
function set_select() {
	$('#submitMatch').click(function() {
		$.fancybox.close();
		$.post('" . Yii::app()->createAbsoluteUrl('/family/findMatch') . "', {
			'family': $('input:checked').val()
		}, update_family, 'json' );
	} );
}
$('#family-search').fancybox( {
	'onComplete': function() {
		set_find();
		set_sort();
		set_select();
	}
} );
function set_clear_fields() {
	$('#family-clear').click(function() {
		$('#Subscription_family_head').val('');
		$('#Subscription_family_id').val('');
		$('#Subscription_till').attr('disabled', false);
		return false;
	} );
}
set_clear_fields();
");

$gridScriptUrl=Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('zii.widgets.assets'));
Yii::app()->clientScript->registerCssFile($gridScriptUrl.'/gridview/styles.css');  

$pagerScriptUrl=Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('system.web.widgets.pagers'));
Yii::app()->clientScript->registerCssFile($pagerScriptUrl.'/pager.css');  

?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'subscription-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php
		if (isset($family)) {
			$fid = $family->id;
			$head_name = $family->head_name;
		} else {
			$fid = $head_name = '';
		}
		echo CHtml::label('Family of', 'Subscription_family_head', array('required'=>true,'style'=>'display:inline'));
		echo CHtml::link(CHtml::image(Yii::app()->request->baseUrl . '/images/search.png','family search',array('height'=>14,'width'=>'14')),
			array('/family/findMatch'), array('id' => 'family-search'));
		echo CHtml::link(CHtml::image(Yii::app()->request->baseUrl . '/images/clear.png','family clear',array('height'=>14,'width'=>14)),
			array('#'), array('id' => 'family-clear', 'title' => 'Clear family fields')) . '<br />';
		echo CHtml::textField('head_name', $head_name, array(
			'id'=>'Subscription_family_head', 'size'=>60, 'maxlength'=>99, 'readonly'=>true));
		echo $form->hiddenField($model,'family_id',array('value'=>$fid)); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'paid_by'); ?>
		<?php echo $form->textField($model,'paid_by',array('size'=>60,'maxlength'=>99)); ?>
		<?php echo $form->error($model,'paid_by'); ?>
	</div>

	<div class="row">
	<span class="leftHalf">
		<?php echo CHtml::label('Till Month', 'Subscription_till', array('required'=>true)); ?>
		<?php $parms = array();
			if (isset($start_dt)) {
				$parms['start_dt'] = $start_dt;
			}
			echo '<span id="spn_till_month">';
			$this->renderPartial('_till_month', $parms);
			echo '</span>'; ?>
	</span>

	<span class="rightHalf">
		<?php echo CHtml::label('Amount', 'Subscription_amount', array('required' => true)); ?>
		<?php echo CHtml::dropDownList('duration', '', array('total' => 'Total', 'monthly' => 'Monthly')); ?>
		<?php echo CHtml::textField('Subscription[amount]','',array('id'=>'Subscription_amount', 'size' => 7)); ?>
	</span>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

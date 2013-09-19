<?php
/* @var $this ConfirmationRecordsController */
/* @var $model ConfirmationRecord */
/* @var $form CActiveForm */

$this->widget('application.extensions.fancybox.EFancyBox', array(
    'target'=>'a[rel=gallery]',
	'config'=>array(),
));

Yii::app()->clientScript->registerScript('findMatches', "
function set_find() {
	$('#findMatchForm').submit(function() {
		$.get('" . Yii::app()->request->baseUrl . "/person/findMatch', {
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
function update_member(p) {
	$('#ConfirmationRecord_name').val(p.name).attr('readonly', true);
	$('#ConfirmationRecord_dob').val(p.dob).attr('readonly', true);
	$('#ConfirmationRecord_baptism_dt').val(p.baptism_dt).attr('readonly', true);
	$('#ConfirmationRecord_baptism_place').val(p.baptism_place);
	$('#ConfirmationRecord_parents_name').val(p.parents_name).attr('readonly', true);
	$('#ConfirmationRecord_godparent_name').val(p.god_parents).attr('readonly', true);
	$('#ConfirmationRecord_member_id').val(p.id);
}
function set_select() {
	$('#submitMatch').click(function() {
		$.post('" . Yii::app()->request->baseUrl . "/person/findMatch". "', {
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
	}
} );

function set_clear_fields(id) {
	$('#member_clear').click(function() {
		$('#ConfirmationRecord_name').val('').attr('readonly', false);
		$('#ConfirmationRecord_dob').val('').attr('readonly', false);
		$('#ConfirmationRecord_baptism_dt').val('').attr('readonly', false);
		$('#ConfirmationRecord_baptism_place').val('');
		$('#ConfirmationRecord_parents_name').val('').attr('readonly', false);
		$('#ConfirmationRecord_godparent_name').val('').attr('readonly', false);
		$('#ConfirmationRecord_member_id').val('');
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
	'id'=>'confirmation-record-form',
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
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>75)); ?>
		<?php echo $form->hiddenField($model,'member_id'); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'church'); ?>
		<?php echo $form->textField($model,'church',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'church'); ?>
	</div>

	<div class="row">
	<span class="leftHalf">
		<?php echo $form->labelEx($model,'confirmation_dt'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'attribute' => "confirmation_dt",
			'options'	=> array(
				'dateFormat' => 'yy-mm-dd',
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
		<?php echo $form->labelEx($model,'dob'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'attribute' => "dob",
			'options'	=> array(
				'dateFormat' => 'yy-mm-dd',
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
		<?php echo $form->labelEx($model,'baptism_dt'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'attribute' => "baptism_dt",
			'options'	=> array(
				'dateFormat' => 'yy-mm-dd',
				'changeYear' => true
			),
			'htmlOptions' => array(
				'size' => '10',         // textField size
				'maxlength' => '10',    // textField maxlength
			),
		)); ?>
		<?php echo $form->error($model,'baptism_dt'); ?>
	</span>
	<span class="rightHalf">
		<?php echo $form->labelEx($model,'baptism_place'); ?>
		<?php echo $form->textField($model,'baptism_place',array('size'=>25,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'baptism_place'); ?>
	</span>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'parents_name'); ?>
		<?php echo $form->textField($model,'parents_name',array('size'=>50,'maxlength'=>75)); ?>
		<?php echo $form->error($model,'parents_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'godparent_name'); ?>
		<?php echo $form->textField($model,'godparent_name',array('size'=>50,'maxlength'=>75)); ?>
		<?php echo $form->error($model,'godparent_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'residence'); ?>
		<?php echo $form->textField($model,'residence',array('size'=>50,'maxlength'=>75)); ?>
		<?php echo $form->error($model,'residence'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'minister'); ?>
		<?php echo $form->textField($model,'minister',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'minister'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

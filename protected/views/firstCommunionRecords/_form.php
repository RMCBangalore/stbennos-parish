<?php
/* @var $this FirstCommunionRecordsController */
/* @var $model FirstCommunionRecord */
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
	$('#FirstCommunionRecord_name').val(p.name).attr('readonly', true);
	$('#FirstCommunionRecord_member_id').val(p.id);
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
		$('#FirstCommunionRecord_name').val('').attr('readonly', false);
		$('#FirstCommunionRecord_member_id').val('');
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
	'id'=>'first-communion-record-form',
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
		<?php echo $form->textField($model,'church',array('size'=>40,'maxlength'=>50,
			'value'=>Yii::app()->params['parishName'])); ?>
		<?php echo $form->error($model,'church'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'communion_dt'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'attribute' => "communion_dt",
			'options'	=> array(
				'dateFormat' => 'yy-mm-dd',
				'changeYear' => true
			),
			'htmlOptions' => array(
				'size' => '10',         // textField size
				'maxlength' => '10',    // textField maxlength
			),
		)); ?>
		<?php echo $form->error($model,'communion_dt'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

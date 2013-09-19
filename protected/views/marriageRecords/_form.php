<?php
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
		$.get('" . Yii::app()->request->baseUrl . "/person/findMatch', {
			'sex': crit['sex'],
			'key': $('#key').val()
		}, function(data) {
			$('#fancybox-content').html(data);
			set_find(crit);
			set_sort(crit);
			set_select(crit);
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
		} );
		return false;
	} );
}
function get_cb(id) {
	return function(p) {
		$('#MarriageRecord_'+id+'_name').val(p.name).attr('readonly', true);
		$('#MarriageRecord_'+id+'_dob').val(p.dob).attr('readonly', true);
		$('#MarriageRecord_'+id+'_dob').datepicker().datepicker('disable');
		$('#MarriageRecord_'+id+'_baptism_dt').val(p.baptism_dt).attr('readonly', true);
		$('#MarriageRecord_'+id+'_baptism_dt').datepicker().datepicker('disable');
		$('#MarriageRecord_'+id+'_fathers_name').val(p.fathers_name).attr('readonly', true);
		$('#MarriageRecord_'+id+'_mothers_name').val(p.mothers_name).attr('readonly', true);
		$('#MarriageRecord_'+id+'_rank_prof').val(p.rank_prof);
		$('#MarriageRecord_'+id+'_id').val(p.id);
	}
}
function set_select(crit) {
	$('#submitMatch').click(function() {
		$.fancybox.close();
		$.post('" . Yii::app()->request->baseUrl . "/person/findMatch". "', {
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
	}
} );

function set_clear_fields(id) {
	$('#' + id + '_clear').click(function() {
		$('#MarriageRecord_'+id+'_name').val('').attr('readonly', false);
		$('#MarriageRecord_'+id+'_dob').val('').attr('readonly', false);
		$('#MarriageRecord_'+id+'_dob').datepicker('enable');
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
	<span class="leftHalf">
		<?php echo $form->labelEx($model,'marriage_dt'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'attribute' => "marriage_dt",
			'options'	=> array(
				'dateFormat' => 'yy-mm-dd',
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
		<?php echo $form->labelEx($model,'banns_licence'); ?>
		<?php echo $form->dropDownList($model,'banns_licence',array('banns' => 'Banns', 'licence' => 'Licence'), array('prompt' => '-- Select one --')); ?>
		<?php echo $form->error($model,'banns_licence'); ?>
	</span>
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

<?php
$this->widget('application.extensions.fancybox.EFancyBox', array(
    'target'=>'a[rel=gallery]',
	'config'=>array(),
));

Yii::app()->clientScript->registerScript('findGroom', "
function set_find_groom() {
	$('#findMatchForm').submit(function() {
		$.get('" . Yii::app()->request->baseUrl . "/person/findMatch', {
			'sex': 'male',
			'key': $('#key').val()
		}, function(data) {
			$('#fancybox-content').html(data);
			set_find_groom();
			set_sort_groom();
			set_select_groom();
		} );
		return false;
	} );
	$('#key').focus();
}
function set_sort_groom() {
	$('a.sort-link').click(function() {
		$.get($(this).attr('href'), function(data) {
			$('#fancybox-content').html(data);
			set_find_groom();
			set_sort_groom();
			set_select_groom();
		} );
		return false;
	} );
}
function set_select_groom() {
	$('#submitMatch').click(function() {
		$.fancybox.close();
		$.post('" . Yii::app()->request->baseUrl . "/person/findMatch". "', {
			'person': $('input:checked').val()
		}, function(p) {
			$('#MarriageRecord_groom_name').val(p.name);
			$('#MarriageRecord_groom_dob').val(p.dob);
			$('#MarriageRecord_groom_baptism_dt').val(p.baptism_dt);
			$('#MarriageRecord_groom_fathers_name').val(p.fathers_name);
			$('#MarriageRecord_groom_mothers_name').val(p.mothers_name);
			$('#MarriageRecord_groom_rank_prof').val(p.rank_prof);
		}, 'json' );
	} );
}
$('#groom_search').fancybox( {
	'onComplete': function() {
		set_find_groom();
		set_sort_groom();
		set_select_groom();
	}
} );
");
?>

	<div class="row">
	<span class="leftHalf">
		<?php echo $form->labelEx($model,'groom_name', array('style'=>'display:inline')); ?>
		<?php echo CHtml::link(CHtml::image(Yii::app()->request->baseUrl . '/images/search.png'),
			array('/person/findMatch', 'sex' => 'male'), array('id' => 'groom_search')); ?>
		<?php echo $form->textField($model,'groom_name',array('size'=>35,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'groom_name'); ?>
	</span>

	<span class="rightHalf">
		<?php echo $form->labelEx($model,'groom_baptism_dt'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'attribute' => "groom_baptism_dt",
			'options'	=> array(
				'dateFormat' => 'yy-mm-dd',
				'changeYear' => true
			),
			'htmlOptions' => array(
				'size' => '10',         // textField size
				'maxlength' => '10',    // textField maxlength
			),
		)); ?>
		<?php echo $form->error($model,'groom_baptism_dt'); ?>
	</span>
	</div>

	<div class="row">
	<span class="leftHalf">
		<?php echo $form->labelEx($model,'groom_status'); ?>
		<?php echo $form->dropDownList($model,'groom_status', array(
			'Married' => 'Married',
			'Widowed' => 'Widowed',
			'Divorced' => 'Divorced'), array('prompt' => '-- Select --')); ?>
		<?php echo $form->error($model,'groom_status'); ?>
	</span>

	<span class="rightHalf">
		<?php echo $form->labelEx($model,'groom_rank_prof'); ?>
		<?php echo $form->textField($model,'groom_rank_prof',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'groom_rank_prof'); ?>
	</span>
	</div>

	<div class="row">
	<span class="leftHalf">
		<?php echo $form->labelEx($model,'groom_fathers_name'); ?>
		<?php echo $form->textField($model,'groom_fathers_name',array('size'=>40,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'groom_fathers_name'); ?>
	</span>
	<span class="rightHalf">
		<?php echo $form->labelEx($model,'groom_mothers_name'); ?>
		<?php echo $form->textField($model,'groom_mothers_name',array('size'=>40,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'groom_mothers_name'); ?>
	</span>
	</div>

	<div class="row">
	<span class="leftHalf">
		<?php echo $form->labelEx($model,'groom_dob'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'attribute' => "groom_dob",
			'options'	=> array(
				'dateFormat' => 'yy-mm-dd',
				'changeYear' => true
			),
			'htmlOptions' => array(
				'size' => '10',         // textField size
				'maxlength' => '10',    // textField maxlength
			),
		)); ?>
		<?php echo $form->error($model,'groom_dob'); ?>
	</span>

	<span class="rightHalf">
		<?php echo $form->labelEx($model,'groom_residence'); ?>
		<?php echo $form->textField($model,'groom_residence',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'groom_residence'); ?>
	</span>
	</div>



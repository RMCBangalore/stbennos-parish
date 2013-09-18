<?php
$this->widget('application.extensions.fancybox.EFancyBox', array(
    'target'=>'a[rel=gallery]',
	'config'=>array(),
));

Yii::app()->clientScript->registerScript('findBride', "
function set_find_bride() {
	$('#findMatchForm').submit(function() {
		$.get('" . Yii::app()->request->baseUrl . "/person/findMatch', {
			'sex': 'female',
			'key': $('#key').val()
		}, function(data) {
			$('#fancybox-content').html(data);
			set_find_bride();
			set_sort_bride();
			set_select_bride();
		} );
		return false;
	} );
	$('#key').focus();
}
function set_sort_bride() {
	$('a.sort-link').click(function() {
		$.get($(this).attr('href'), function(data) {
			$('#fancybox-content').html(data);
			set_find_bride();
			set_sort_bride();
			set_select_bride();
		} );
		return false;
	} );
}
function set_select_bride() {
	$('#submitMatch').click(function() {
		$.fancybox.close();
		$.post('" . Yii::app()->request->baseUrl . "/person/findMatch". "', {
			'person': $('input:checked').val()
		}, function(p) {
			$('#MarriageRecord_bride_name').val(p.name);
			$('#MarriageRecord_bride_dob').val(p.dob);
			$('#MarriageRecord_bride_baptism_dt').val(p.baptism_dt);
			$('#MarriageRecord_bride_fathers_name').val(p.fathers_name);
			$('#MarriageRecord_bride_mothers_name').val(p.mothers_name);
			$('#MarriageRecord_bride_rank_prof').val(p.rank_prof);
		}, 'json' );
	} );
}
$('#bride_search').fancybox( {
	'onComplete': function() {
		set_find_bride();
		set_sort_bride();
		set_select_bride();
	}
} );
");

$baseScriptUrl=Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('zii.widgets.assets'));

Yii::app()->clientScript->registerCssFile($baseScriptUrl.'/gridview/styles.css');  

?>

	<div class="row">
	<span class="leftHalf">
		<?php echo $form->labelEx($model,'bride_name', array('style'=>'display:inline')); ?>
		<?php echo CHtml::link(CHtml::image(Yii::app()->request->baseUrl . '/images/search.png'),
			array('/person/findMatch', 'sex' => 'female'), array('id' => 'bride_search')); ?>
		<?php echo $form->textField($model,'bride_name',array('size'=>35,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'bride_name'); ?>
	</span>

	<span class="rightHalf">
		<?php echo $form->labelEx($model,'bride_baptism_dt'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'attribute' => "bride_baptism_dt",
			'options'	=> array(
				'dateFormat' => 'yy-mm-dd',
				'changeYear' => true
			),
			'htmlOptions' => array(
				'size' => '10',         // textField size
				'maxlength' => '10',    // textField maxlength
			),
		)); ?>
		<?php echo $form->error($model,'bride_baptism_dt'); ?>
	</span>
	</div>

	<div class="row">
	<span class="leftHalf">
		<?php echo $form->labelEx($model,'bride_status'); ?>
		<?php echo $form->dropDownList($model,'bride_status', array(
			'Married' => 'Married',
			'Widowed' => 'Widowed',
			'Divorced' => 'Divorced'), array('prompt' => '-- Select --')); ?>
		<?php echo $form->error($model,'bride_status'); ?>
	</span>

	<span class="rightHalf">
		<?php echo $form->labelEx($model,'bride_rank_prof'); ?>
		<?php echo $form->textField($model,'bride_rank_prof',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'bride_rank_prof'); ?>
	</span>
	</div>

	<div class="row">
	<span class="leftHalf">
		<?php echo $form->labelEx($model,'bride_fathers_name'); ?>
		<?php echo $form->textField($model,'bride_fathers_name',array('size'=>40,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'bride_fathers_name'); ?>
	</span>
	<span class="rightHalf">
		<?php echo $form->labelEx($model,'bride_mothers_name'); ?>
		<?php echo $form->textField($model,'bride_mothers_name',array('size'=>40,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'bride_mothers_name'); ?>
	</span>
	</div>

	<div class="row">
	<span class="leftHalf">
		<?php echo $form->labelEx($model,'bride_dob'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'attribute' => "bride_dob",
			'options'	=> array(
				'dateFormat' => 'yy-mm-dd',
				'changeYear' => true
			),
			'htmlOptions' => array(
				'size' => '10',         // textField size
				'maxlength' => '10',    // textField maxlength
			),
		)); ?>
		<?php echo $form->error($model,'bride_dob'); ?>
	</span>

	<span class="rightHalf">
		<?php echo $form->labelEx($model,'bride_residence'); ?>
		<?php echo $form->textField($model,'bride_residence',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'bride_residence'); ?>
	</span>
	</div>



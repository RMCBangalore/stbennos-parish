<?php
/* @var $this SurveyReportsController */

$this->breadcrumbs=array(
	'Survey Reports',
);

Yii::app()->clientScript->registerScript('search', "
$('#submit-button').click(function(){
	$.get('" . Yii::app()->createUrl('SurveyReports/awareness') . "', {
		'awareness_id': $('#awareness_id').val()
	}, function(data) {
		$('#awareness-report').html(data);
	} );
	return false;
});
");
?>

<h1><?php echo 'Awareness Report'; ?></h1>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'awareness-report-form',
	'enableAjaxValidation'=>false,
)); ?>

	<div class="row">
		<?php echo CHtml::label('Awareness Item', 'awareness_id'); ?>
		<?php echo CHtml::dropDownList('awareness_id', null, /* $awarenessItems,*/
			CHtml::listData($awarenessItems, 'id', 'text'),
			array('id' => 'awareness_id', 'prompt' => 'All')); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Generate', array('id' => 'submit-button')); ?>
	</div>

	<div id="awareness-report"></div>

<?php $this->endWidget(); ?>

</div><!-- form -->


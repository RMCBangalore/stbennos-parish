<?php
/* @var $this SurveyReportsController */

$this->breadcrumbs=array(
	'Survey Reports',
);

Yii::app()->clientScript->registerScript('search', "
$('#submit-button').click(function(){
	$.get('" . Yii::app()->createUrl('SurveyReports/openQuestions') . "', {
		'question_id': $('#question_id').val()
	}, function(data) {
		$('#question-report').html(data);
	} );
	return false;
});
");
?>

<h1><?php echo 'Open Questions Report'; ?></h1>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'question-report-form',
	'enableAjaxValidation'=>false,
)); ?>

	<div class="row">
		<?php echo CHtml::label('Question', 'question_id'); ?>
		<?php echo CHtml::dropDownList('question_id', null, /* $openQuestions,*/
			CHtml::listData($openQuestions, 'id', 'text'),
			array('id' => 'question_id', 'prompt' => 'All Yes/No Questions')); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Generate', array('id' => 'submit-button')); ?>
	</div>

	<div id="question-report"></div>

<?php $this->endWidget(); ?>

</div><!-- form -->


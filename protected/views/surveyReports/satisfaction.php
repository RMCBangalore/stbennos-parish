<?php
/* @var $this SurveyReportsController */

$this->breadcrumbs=array(
	'Survey Reports',
);

Yii::app()->clientScript->registerScript('search', "
$('#submit-button').click(function(){
	$.get('" . Yii::app()->createUrl('SurveyReports/satisfaction') . "', {
		'satisfaction_item_id': $('#satisfaction_item_id').val()
	}, function(data) {
		$('#satisfaction-report').html(data);
	} );
	return false;
});
");
?>

<h1><?php echo 'Satisfaction Items Report'; ?></h1>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'satisfaction-report-form',
	'enableAjaxValidation'=>false,
)); ?>

	<div class="row">
		<?php echo CHtml::label('Satisfaction Item', 'satisfaction_item_id'); ?>
		<?php echo CHtml::dropDownList('satisfaction_item_id', null, /* $satisfactionItems,*/
			CHtml::listData($satisfactionItems, 'id', 'text'),
			array('id' => 'satisfaction_item_id', 'prompt' => 'All')); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Generate', array('id' => 'submit-button')); ?>
	</div>

	<div id="satisfaction-report"></div>

<?php $this->endWidget(); ?>

</div><!-- form -->


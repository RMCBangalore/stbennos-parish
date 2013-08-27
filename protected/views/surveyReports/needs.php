<?php
/* @var $this SurveyReportsController */

$this->breadcrumbs=array(
	'Survey Reports',
);

Yii::app()->clientScript->registerScript('search', "
$('#submit-button').click(function(){
	$.get('" . Yii::app()->createUrl('SurveyReports/needs') . "', {
		'need_id': $('#need_id').val()
	}, function(data) {
		$('#needs-report').html(data);
	} );
	return false;
});
");
?>

<h1><?php echo 'Need Items Report'; ?></h1>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'needs-report-form',
	'enableAjaxValidation'=>false,
)); ?>

	<div class="row">
		<?php echo CHtml::label('Need Item', 'need_id'); ?>
		<?php echo CHtml::dropDownList('need_id', null, /* $needItems,*/
			CHtml::listData($needItems, 'id', 'text'),
			array('id' => 'need_id', 'prompt' => 'All')); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Generate', array('id' => 'submit-button')); ?>
	</div>

	<div id="needs-report"></div>

<?php $this->endWidget(); ?>

</div><!-- form -->


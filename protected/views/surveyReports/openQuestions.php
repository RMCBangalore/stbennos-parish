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
		if (1 == $('#question-report table tbody tr').size()) {
			var data = new Array();
			var keys = new Array();
			$('#question-report table thead th.option').each(function(i, e) {
				keys[i] = $(e).html();				
			} );
			$('#question-report table tbody tr td.count').each(function(i, e) {
				var n = $(e).html();
				if (n != 0) {
					n = n.replace('/^.*(/', '').replace('/)$/', '');
				}
				data[i] = [ keys[i], parseFloat(n) ];
			} );
			var chart = new Highcharts.Chart({
				'chart': {
					'renderTo':'chart',
					plotBackgroundColor: null,
					plotBorderWidth: null,
					plotShadow: false
				},
				'title': {'text': 'Open Questions Chart' },
				plotOptions: {
					pie: {
						allowPointSelect: true,
							cursor: 'pointer',
							dataLabels: {
								enabled: true,
								color: '#000000',
								connectorColor: '#000000',
								format: '<b>{point.name}</b>: {point.percentage:.1f} %'
							}
					}
				},
				'series':[{
					type: 'pie',
					name: 'Open Questions Chart',
					data: data
				}],
			});
			$('#chart').css('height', 'auto');
		} else {
			$('#chart').html('').css('height', '10px');
		}
	} );
	return false;
});
");

$baseUrl = Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('ext.highcharts.assets'));
Yii::app()->clientScript->registerScriptFile($baseUrl.'/highcharts.js');
Yii::app()->clientScript->registerScriptFile($baseUrl.'/highcharts.src.js');

?>

<style>
#chart {
	float: right;
	width: 500px;
}
</style>

<div id="chart"></div>

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


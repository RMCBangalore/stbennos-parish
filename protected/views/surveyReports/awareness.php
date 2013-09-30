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
		if (1 == $('#awareness-report table tbody tr').size()) {
			var data = new Array();
			var keys = new Array();
			$('#awareness-report table thead th.option').each(function(i, e) {
				keys[i] = $(e).html();				
			} );
			$('#awareness-report table tbody tr td.count').each(function(i, e) {
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
				'title': {'text': 'Awareness: ' + $('#awareness_id :selected').text() },
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
					name: 'Awareness Chart',
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


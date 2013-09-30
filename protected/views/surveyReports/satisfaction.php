<?php
/* @var $this SurveyReportsController */

$this->breadcrumbs=array(
	'Survey Reports',
);

$baseUrl = Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('ext.highcharts.assets'));
Yii::app()->clientScript->registerScriptFile($baseUrl.'/highcharts.js');

Yii::app()->clientScript->registerScript('search', "
$('#submit-button').click(function(){
	$.get('" . Yii::app()->createUrl('SurveyReports/satisfaction') . "', {
		'satisfaction_item_id': $('#satisfaction_item_id').val()
	}, function(data) {
		$('#satisfaction-report').html(data);
		if (1 == $('#satisfaction-report table tbody tr').size()) {
			var data = new Array();
			var keys = new Array();
			$('#satisfaction-report table thead th.option').each(function(i, e) {
				keys[i] = $(e).html();				
			} );
			$('#satisfaction-report table tbody tr td.count').each(function(i, e) {
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
				'title': {'text': 'Satisfaction: ' + $('#satisfaction_item_id :selected').text() },
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
					name: 'Satisfaction Chart',
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

?>

<style>
#chart {
	float: right;
	width: 500px;
}
</style>

<div id="chart"></div>

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


<?php
#
# This file is part of Alive Parish Software
#
# Alive Parish - software to manage tomorrow's parish
# Copyright (C) 2013  Redemptorist Media Center
#
# Alive Parish Software is free software: you can redistribute it
# and/or modify it under the terms of the GNU General Public License as
# published by the Free Software Foundation, either version 3 of the
# License, or (at your option) any later version.
#
# Alive Parish Software is distributed in the hope that it will
# be useful, but WITHOUT ANY WARRANTY; without even the implied warranty
# of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
#
# You should have received a copy of the GNU General Public License
# along with this program.  If not, see <http://www.gnu.org/licenses/>.
#
/* @var $this SurveyReportsController */

$this->breadcrumbs=array(
	'Reports'=>array('/reports'),
	'Needs Analysis',
);

Yii::app()->clientScript->registerScript('search', "
$('#submit-button').click(function(){
	$.get('" . Yii::app()->createUrl('SurveyReports/needs') . "', {
		'need_id': $('#need_id').val()
	}, function(data) {
		$('#needs-report').html(data);
		if (1 == $('#needs-report table tbody tr').size()) {
			var data = new Array();
			var keys = new Array();
			$('#needs-report table thead th.option').each(function(i, e) {
				keys[i] = $(e).html();				
			} );
			$('#needs-report table tbody tr td.count').each(function(i, e) {
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
				'title': {'text': 'Needs: ' + $('#need_id :selected').text() },
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
					name: 'Needs Chart',
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


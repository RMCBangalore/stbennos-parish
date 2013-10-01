<?php
/* @var $this ReportsController */

$this->breadcrumbs=array(
	'Reports'=>array('/reports'),
	'Anniversaries',
);
?>
<h1>Anniversaries Report</h1>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'anniversary-report-form',
	'enableAjaxValidation'=>false,
)); ?>

	<div class="row">
	<span class="leftHalf">
		<?php
		echo CHtml::label('Date', 'People_marriage_dt');
		$this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'attribute' => 'marriage_dt',
			'options'	=> array(
				'dateFormat' => 'yy-mm-dd',
				'minDate'	=> -31,
				'changeYear' => true
			),
			'htmlOptions' => array(
				'size' => '10',         // textField size
				'maxlength' => '10',    // textField maxlength
			),
		));
		?>
	</span>
	<span class="rightHalf">
	<?php
		echo CHtml::label('Period', 'period');
		echo CHtml::dropDownList('period', '', array('day' => 'A Day',
												'week' => 'A Week',
												'month' => 'A Month'), array('id'=>'period'));
	?>
	</span>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Generate'); ?>
	</div>

<?php $this->endWidget(); ?>
</div>

<div id="anniversary-result">
</div>

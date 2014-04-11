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
/* @var $this ReportsController */

Yii::app()->clientScript->registerScript('rangeSet', "
$('#cust-range').hide();
$('#range').change(function(e) {
	switch (this.value) {
	case 'monthly':
		$('#subrange').html('<option value=\'last-month\'>Last Month</option>' +
		'<option value=\'this-month\'>This Month</option>');
		$('#cust-range').hide();
		$('#subrange-span').prev().addClass('leftHalf');
		$('#subrange-span').show();
		break;
	case 'yearly':
		$('#subrange').html('<option value=\'last-year\'>Last Year</option>' +
		'<option value=\'this-year\'>This Year</option>');
		$('#cust-range').hide();
		$('#subrange-span').prev().addClass('leftHalf');
		$('#subrange-span').show();
		break;
	case 'fy':
		$('#subrange').html('<option value=\'last-fy\'>Last F.Y</option>' +
		'<option value=\'this-fy\'>This F.Y</option>');
		$('#cust-range').hide();
		$('#subrange-span').prev().addClass('leftHalf');
		$('#subrange-span').show();
		break;
	case 'custom':
		$('#subrange').html('<option value=\'\'>-- Select range --</option>');
		$('#cust-range').show();
		$('#subrange-span').prev().removeClass('leftHalf');
		$('#subrange-span').hide();
		break;
	}
} );
");

?>

<h1>Account Statement</h1>

<?php if (isset($data)): ?>

<div class="summary">
<span class="label">Statement from:</span>
<span class="value"><?php echo $from_dt . ' to ' . $to_dt ?></span>
<br />
<span class="label">Balance on <?php echo $from_dt ?>:</span>
<span class="value">
	<?php $NF = Yii::app()->numberFormatter;
		$cur = Parish::get()->currency;
		echo CHtml::encode($NF->formatCurrency($obal, $cur)); ?>
</span>
</div>

<table class="accounts">
<thead>
	<tr>
		<th>Date</th>
		<th>Account Category</th>
		<th>Description</th>
		<th class="rt">Credit</th>
		<th class="rt">Debit</th>
		<th class="rt">Balance</th>
	</tr>
</thead>
<tbody>
<?php $bal = $obal;
foreach($data as $trans): ?>
	<tr>
		<td><?php echo $trans->created ?></td>
		<td><?php echo $trans->account->name ?></td>
		<td><?php echo $trans->descr ?></td>
		<td class="rt"><?php if ('credit' === $trans->type) {
			echo CHtml::encode($NF->formatCurrency($trans->amount, $cur));
			$bal += $trans->amount;
		} ?></td>
		<td class="rt"><?php if ('debit' === $trans->type) {
			echo CHtml::encode($NF->formatCurrency($trans->amount, $cur));
			$bal -= $trans->amount;
		} ?></td>
		<td class="rt"><?php echo $NF->formatCurrency($bal, $cur) ?></td>
	</tr>
<?php endforeach ?>
</tbody>
</table>

<?php else: ?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'account-statement-form',
	'enableAjaxValidation'=>false,
)); ?>

	<div class="row">
	<span class="leftHalf">
		<?php
			echo CHtml::label('Range', 'range');
			echo CHtml::dropDownList('range', null, array('monthly' => 'Monthly', 'yearly' => 'Yearly', 'fy' => 'Financial', 'custom' => 'Custom'), array('id' => 'range', 'prompt' => '-- Select --'));
		?>
	</span>
	<span id="subrange-span" class="rightHalf">
		<?php
			echo CHtml::label('Subrange', 'subrange');
			echo CHtml::dropDownList('subrange', null, array(), array('prompt' => '-- Select --', 'id' => 'subrange'));
		?>
	</span>
	</div>

	<div id="cust-range" class="row">
	<span class="leftHalf">
		<?php
		echo CHtml::label('From', 'from_dt');
		$this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'name' => 'from_dt',
			'options'	=> array(
				'dateFormat' => Yii::app()->params['dateFmtDP'],
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
		echo CHtml::label('To', 'to_dt');
		$this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'name' => 'to_dt',
			'options'	=> array(
				'dateFormat' => Yii::app()->params['dateFmtDP'],
				'changeYear' => true
			),
			'htmlOptions' => array(
				'size' => '10',         // textField size
				'maxlength' => '10',    // textField maxlength
			),
		));
		?>
	</span>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Generate'); ?>
	</div>

<?php $this->endWidget(); ?>
</div>
<?php endif ?>


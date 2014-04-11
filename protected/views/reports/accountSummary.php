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

?>

<h1>Account Summary</h1>

<?php if (isset($accounts)): ?>

<div class="summary">
<span class="label">Parish Name:</span>
<span class="value"><?php echo strtoupper(Parish::get()->name) ?></span>
<br />
<span class="label">Address:</span>
<span class="value"><?php $parish = Parish::get(); echo $parish->address ?>,<br>
<span class="indent"><?php echo $parish->city ?> - <?php echo $parish->pin ?></span></span>
<br />
<span class="label">Period from:</span>
<span class="value"><?php echo $from_dt . ' to ' . $to_dt ?></span>
<br />
</div>

<table class="accounts">
<thead>
	<tr>
		<th rowspan="2">Account</th>
		<th rowspan="2" class="rt">Opening Balance</th>
		<th colspan="2" class="rt">Transactions</th>
		<th rowspan="2" class="rt">Closing Balance</th>
	</tr>
	<tr>
		<th class="rt">Credit</th>
		<th class="rt">Debit</th>
	</tr>
</thead>
<tbody>

<?php foreach($accounts as $account) {
	echo "<tr>";
	echo "<th>";
	for($i = 0; $i < $account['depth']; ++$i) {
		echo "&nbsp;";
	}
	if (isset($account['placeholder'])) {
		echo "<span class='ph'>";
	} else {
		echo "<span class='non-ph'>";
	}
	echo $account['name'] . "</span>";
	$NF = Yii::app()->numberFormatter;
	$cur = Parish::get()->currency;
	foreach(array('obal', 'credit', 'debit', 'cbal') as $fld) {
		echo '<td class="rt">';
		echo isset($account[$fld]) ? $NF->formatCurrency($account[$fld], $cur) : '';
		echo '</td>';
	}
	echo "</tr>";
}
?>

</tbody>
</table>

<?php else: ?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'account-summary-form',
	'enableAjaxValidation'=>false,
)); ?>

	<div class="row">
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

	<div class="row buttons">
		<?php echo CHtml::submitButton('Generate'); ?>
	</div>

<?php $this->endWidget(); ?>
</div>
<?php endif ?>


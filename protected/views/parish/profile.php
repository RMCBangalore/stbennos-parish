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
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;

$this->breadcrumbs = array(
	'Parish Profile'
);

/*
Yii::app()->clientScript->registerScript('gen-report', "
$('#parish-profile-form').submit(function() {
	$.post($(this).attr('action'), $(this).serilize(), function(data) {

	window.open('" . Yii::app()->createUrl('/reports/parishProfile') . "')
} );
")
*/

?>
<style>
table.profile {
	float: left;
	max-width: 45%;
	margin-right: 20px;
	width: 20em;
}
table.profile caption {
	font-size: 135%;
	word-spacing: 0.2em;
	background-color: #689;
	color: #f0f4f8;
	border: 1px solid #abc;
}
table.profile th {
	background-color: #eef2f8;
	font-family: Garamond, serif;
	font-size: 110%;
	color: #245;
}
table.profile td span.val a {
	color: #4463ad;
	font-size: 140%;
	font-family: Garamond, serif;
	letter-spacing: -0.02em;
}
table.profile td {
	padding: 2px 10px;
}
fieldset {
	border: 1px solid #aa9;
	padding: 14px 30px 15px 10px;
	width: auto;
	float: left;
	margin-left: 20px;
}
fieldset legend {
	font: normal 140% 'Trebuchet MS', serif;
	padding: 2px 5px;
	background: #abb;
	border: 1px solid #a98;
	color: #fff;
}
#parish-profile-form select {
	padding: 2px 5px;
	font-size: 110%;
}
#gen-report {
	font: bold 110% Georgia;
	color: #293158;
	padding: 5px 10px;
	border-radius: 10px;
	margin-left: 10px;
}
#gen-report:hover {
	background-color: #edf5f3;
	border-color: #dde5e3;
}
</style>

<h1>Parish Profile: <?php echo CHtml::encode(Parish::get_name()); ?></h1>


<table class="cellular profile">
<caption>Parishioner Summary</caption>
</tbody>
<tr>
	<th>Total Families</th>
	<td><span class='val'><?php echo CHtml::link($families, array('family/index')); ?></span></td>
</tr>
<tr>
	<th>Total Members</th>
	<td><span class='val'><?php echo CHtml::link($members, array('person/index')); ?></span></td>
</tr>
<tr>
	<th>Members Baptised</th>
	<td><span class='val'><?php echo CHtml::link($baptised, array('person/baptised')); ?></span></td>
</tr>
<tr>
	<th>Members Confirmed</th>
	<td><span class='val'><?php echo CHtml::link($confirmed, array('person/confirmed')); ?></span></td>
</tr>
<tr>
	<th>Members Married</th>
	<td><span class='val'><?php echo CHtml::link($married, array('person/married')); ?></span></td>
</tr>
</tbody>
</table>

<fieldset>
<legend>Parish Annual Report</legend>
<?php
$form=$this->beginWidget('CActiveForm', array(
	'id' => 'parish-profile-form',
	'enableAjaxValidation'=>false,
	'action'=>Yii::app()->createUrl('/reports/parishProfile'),
	'htmlOptions' => array(
		'target'=>'_blank',
	)
));
$yr = date_format(new DateTime(), 'Y');
echo CHtml::label('For: ', 'period');
echo CHtml::dropDownList('period', null, array($yr => "This Year ($yr)", $yr-1 => 'Last Year ('.($yr-1).')', 'Z' => 'Past 1 Year'));
echo CHtml::submitButton('Generate', array('id'=>"gen-report"));
$this->endWidget();
?>
</fieldset>

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

Yii::app()->clientScript->registerScript('gen-report', "
$('#gen-report').click(function(e) {
	window.open('" . Yii::app()->createUrl('/reports/parishProfile') . "')
} );
")

?>
<style>
table.profile {
	width: auto;
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
#gen-report {
	font-family: Georgia;
	font-size: 130%;
	font-weight: bold;
	color: #293158;
	padding: 5px 10px;
	border-radius: 5px;
}
#gen-report:hover {
	background-color: #cde;
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
<button id="gen-report" type="button">Generate Parish Annual Report</button>

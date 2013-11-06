<?php
#
# This file is part of St. Benno's Parish Software
#
# St. Benno's Parish Software - software to manage tomorrow's parish
# Copyright (C) 2013  Redemptorist Media Center
#
# St. Benno's Parish Software is free software: you can redistribute it
# and/or modify it under the terms of the GNU General Public License as
# published by the Free Software Foundation, either version 3 of the
# License, or (at your option) any later version.
#
# St. Benno's Parish Software is distributed in the hope that it will
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

<h1>Parish Profile: <?php echo CHtml::encode(Parish::get_name()); ?></h1>

<table class="cellular">
<thead>
	<tr>
		<th>Total Families</th>
		<th>Members</th>
		<th>Baptised</th>
		<th>Confirmed</th>
		<th>Married</th>
	</tr>
</thead>
</tbody>
<tr>
	<td><?php echo CHtml::link($families, array('family/index')); ?></td>
	<td><?php echo CHtml::link($members, array('person/index')); ?></td>
	<td><?php echo CHtml::link($baptised, array('person/baptised')); ?></td>
	<td><?php echo CHtml::link($confirmed, array('person/confirmed')); ?></td>
	<td><?php echo CHtml::link($married, array('person/married')); ?></td>
<tr>
</tbody>
</table>
<button id="gen-report" type="button">Generate Parish Profile Report</button>

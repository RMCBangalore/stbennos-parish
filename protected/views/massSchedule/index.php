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
/* @var $this MassScheduleController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Admin' => array('site/page', 'view' => 'admin'),
	'Mass Schedules',
);

$this->menu=array(
	array('label'=>'Create MassSchedule', 'url'=>array('create')),
	array('label'=>'Manage MassSchedule', 'url'=>array('admin')),
);
?>

<h1>Mass Schedule</h1>

<?php

$day_masses = array();
foreach ($schedule as $data) {
	$day = $data->day;
	$mass = array(
		'time' => $data->time,
		'language' => $data->language);

	if (!isset($day_masses[$day])) {
		$day_masses[$day] = array($mass);
	} else {
		array_push($day_masses[$day], $mass);
	}
}

?>

<table class='cellular'>
<thead>
<th>Day of Week</th>
<th>Time</th>
<th>Language</th>
</thead>

<?php
foreach ($day_masses as $day => $masses) {
	$wday = FieldNames::value('weekdays', $day);
	$nm = count($masses);
	echo "<tr><th rowspan='$nm'>$wday</th>";
	foreach ($masses as $i => $mass) {
		if ($i > 0) {
			echo "<tr>";
		}
		echo "<td>" .
			CHtml::encode(date_format(new DateTime($mass['time']), 'g:i a')) .
			"</td><td>" .
			CHtml::encode(FieldNames::value('languages', $mass['language'])) .
			"</td></tr>";
	}
}

?>

</table>


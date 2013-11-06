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
if($data->isRelevantDate) {
	$masses = $this->getMasses($data->date);
	echo '<div class="mass">';
	foreach ($masses as $mass) {
		$text = date_format(new DateTime($mass->time), 'g:ia') . '&nbsp;'
			. substr(FieldNames::value('languages', $mass->language), 0, 3);
		$bookings = $this->getMassBookings($data->date, $mass->id);
		$ttip = null;
		foreach ($bookings as $bkg) {
			if (isset($ttip)) {
				$ttip = $bkg->type . ': ' . $bkg->intention;
			} else {
				$ttip = '&#10;' . $bkg->type . ': ' . $bkg->intention;
			}
		}
		if (isset($ttip)) {
			echo "<a class='mass booked' title='$ttip' onclick='js:return confirm(" . '"Mass already booked. Still want to book?"' . ")' ";
		} else {
			echo "<a class='mass' ";
		}
		echo "href='" . Yii::app()->createUrl('/massBooking/create', array(
			'for' => date_format($data->date, 'Y-m-d '),
			'mass_id' => $mass->id)) . "'>$text</a>";
	}
	echo '</div>';
	echo '<br><br><br><a class="dt" href="' .
		Yii::app()->createUrl('/massBooking/index', array('date' => date_format($data->date, 'Y-m-d'))) .
		'">' . $data->date->format('j') . '</a>';
} else {
	echo '<br><br><br><span class="dt"> ' . $data->date->format('j') . '</span>';
} ?>


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
if($data->isRelevantDate) {
	$masses = $this->getMasses($data->date);
	$class = "";
	$title = "";
	if ($feast = $this->isSpecialMass($data->date)) {
		$class = "special";
		$title = "title='$feast'";
	}
	echo "<div class='mass $class'>";
	echo "<div class='left'>";
	foreach ($masses as $i => $mass) {
		if ($i == 5) echo "</div><div class='right'>";
		$text = date_format(new DateTime($mass->time), 'g:ia') . '&nbsp;' . '&nbsp;';
		$lang = FieldNames::value('languages', $mass->language);
		$bookings = $this->getMassBookings($data->date, $mass->id);
		$ttip = null;
		foreach ($bookings as $bkg) {
			if (isset($ttip)) {
				$ttip .= '&#10;' . $bkg->type . ': ' . $bkg->intention;
			} else {
				$ttip = '&#10;' . $bkg->type . ': ' . $bkg->intention;
			}
		}
		if (isset($ttip)) {
			echo "<a class='mass booked' title='$lang $ttip' onclick='js:return confirm(" . '"Mass already booked. Still want to book?"' . ")' ";
		} else {
			echo "<a class='mass' title='$lang' ";
		}
		if ($data->date > new DateTime()) {
			echo "href='" . Yii::app()->createUrl('/massBooking/create', array(
				'for' => Yii::app()->dateFormatter->formatDateTime($data->date->getTimestamp(), 'short', null),
				'mass_id' => $mass->id));
		}
		echo "'>$text</a>";
	}
	echo '</div>';
	echo '</div>';
	echo "<br><br><br><a $title class='dt $class' href='" .
		Yii::app()->createUrl('/massBooking/index', array('date' => date_format($data->date, 'Y-m-d'))) .
		"'>" . $data->date->format('j') . '</a>';
} else {
	echo '<br><br><br><span class="dt"> ' . $data->date->format('j') . '</span>';
} ?>


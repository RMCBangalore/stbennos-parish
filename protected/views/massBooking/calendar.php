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

$this->breadcrumbs=array(
	'Mass Bookings'=>array('index'),
	'Calendar',
);

$this->menu=array(
	array('label'=>'Create MassBooking', 'url'=>array('create')),
	array('label'=>'Manage MassBooking', 'url'=>array('admin')),
);

Yii::app()->clientScript->registerScript('removeIrrelevant', "
function removeIrrelevant() {
	if ($('#MyCalendar tbody').children('tr').last().children('td').first().hasClass('not-relevant')) {
		$('#MyCalendar tbody').children('tr').last().remove();
	}
}
removeIrrelevant();
");
?>

<h1>Mass Booking Calendar</h1>

<?php
 $this->widget('ecalendarview.ECalendarView', array(
  'id' => 'MyCalendar',
  'weeksInRow' => 1,
  'itemView' => '_cal_view',
  'cssFile' => 'css/calendar.css',
  'ajaxUpdate' => false,
  'dataProvider' => array(
    'pagination' => array(
      'currentDate' => new DateTime("now"),
      'pageSize' => 'month',
      'pageIndex' => 0,
      'pageIndexVar' => 'MyCalendar_page',
      'isMondayFirst' => false,
    )
  )
)); ?>

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

$this->breadcrumbs=array(
	'Reports',
);
?>
<div>
<span class="leftPart">
<h1>People Reports</h1>

<?php
echo '<p>';
#echo CHtml::link('Families', array('families/report'));
#echo '</p><p>';
echo CHtml::link('Birthdays', array('reports/birthdays'));
echo '</p><p>';
echo CHtml::link('Anniversaries', array('reports/anniversaries'));
echo '</p><p>';
echo CHtml::link('Mass Bookings', array('reports/massBookings'));
echo '</p>';
?>
</span>
<span class="centerPart">
<?php $this->renderPartial('../surveyReports/index'); ?>
</span>
<span class="rightPart">
<h1>Financials</h1>

<?php
echo '<p>';
echo CHtml::link('Account Statement', array('reports/accountStatement'));
echo '</p><p>';
echo CHtml::link('Account Summary', array('reports/accountSummary'));
echo '</p>';
?>
</span>
</div>

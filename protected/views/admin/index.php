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
$this->breadcrumbs=array(
	'Admin',
);
?>

<h1>Administer <i><?php echo CHtml::encode(Parish::get_name()); ?></i></h1>

<table>
<tr><td>
<p>
<?php echo CHtml::link('Site Configuration', array('admin/config')); ?>
</p><p>
<?php echo CHtml::link('Manage Users', array('users/admin')); ?>
</p><p>
<?php echo CHtml::link('Manage Rights', array('rights/assignment/view')); ?>
</p><p>
<?php echo CHtml::link('Mass Schedule', array('massSchedule/index')); ?>
</p><p>
<?php echo CHtml::link('Manage Satisfaction Items', array('satisfactionItems/admin')); ?>
</p><p>
<?php echo CHtml::link('Manage Awareness Items', array('awarenessItems/admin')); ?>
</p><p>
<?php echo CHtml::link('Manage Need Items', array('needItems/admin')); ?>
</p><p>
<?php echo CHtml::link('Manage Questions', array('openQuestions/admin')); ?>
</p>
<?php
function show_admin_fv($type) {
	echo "<p>";
	$lbl = ucwords(implode(' ', explode('_', $type)));
	echo CHtml::link("Manage $lbl", array("fieldValue/admin", "type" => $type));
	echo "</p>";
}

foreach(array("marriage_type", "marriage_status", "marital_status") as $type) show_admin_fv($type);
?>
</td><td>
<p>
	<?php echo CHtml::link("Manage Pastors", array("pastor/admin")); ?>
</p>
<?php foreach(array("languages", "zones", "education", "domicile_status",
	"rite", "satisfaction_level", "need_level", "awareness_level",
	"monthly_household_income") as $type) show_admin_fv($type);
?>
</td></tr>
</table>

<p>

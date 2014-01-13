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
/* @var $this SubscriptionController */
/* @var $model Subscription */

$this->breadcrumbs=array(
	'Subscriptions'=>array('index'),
	'Create',
);

if (isset($family)) {
	$this->menu=array(
		array('label'=>'List Subscription', 'url'=>array('index', 'fid' => $family->id)),
		array('label'=>'Manage Subscription', 'url'=>array('admin', 'fid' => $family->id)),
	);
} else {
	$this->menu=array(
		array('label'=>'List Subscription', 'url'=>array('index')),
		array('label'=>'Manage Subscription', 'url'=>array('admin')),
	);
}

?>

<h1>Create Subscription</h1>

<?php
$parms = array('model' => $model);
if (isset($family)) {
	$parms['family'] = $family;
	$parms['start_dt'] = $start_dt;
}
echo $this->renderPartial('_form', $parms); ?>

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
?>

<div id="content">

<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<?php if (Yii::app()->user->isGuest) { ?>
<h1>Welcome!!</h1>

<div class="welcome">
  <ul>
	<li>One-stop place to manage your parish data.</li>
	<li>A software that can make your parish administration very effective.</li>
	<li>Developed with latest technology and cutting edge features.</li>
	<li>User friendly operations and functionality.</li>
  </ul>
Registered User?
<?php echo CHtml::link('Login', array('/site/login')); ?>

</div>
<?php } else { ?>

<h1>Welcome to <i><?php echo CHtml::encode(Parish::get_name()); ?></i></h1>

<?php

$iconMenu = Yii::app()->params['iconMenu'];
foreach($iconMenu as $icon) {
	if (isset($icon['role'])) {
		$role = $icon['role'];
		if (preg_match('/^!/', $role)) {
			$role = preg_replace('/^!/', '', $role);
			if (Yii::app()->user->checkAccess($role)) {
				continue;
			}
		} elseif (!Yii::app()->user->checkAccess($role)) {
			continue;
		}
	}
	$iconUrl = $icon['url'];
	if (preg_match('?^/?', $iconUrl[0])) {
		$action = preg_replace('?^/?', '', $iconUrl[0]);
	}
	$action = ucwords(preg_replace('?/?', '.', $action));
	if (!preg_match('/^Site\./', $action) and !Yii::app()->user->checkAccess($action)) {
		continue;
	}
	if (isset($iconUrl[1])) {
		echo CHtml::link(CHtml::image(Yii::app()->baseUrl . $icon['icon'], $icon['title']),
			Yii::app()->createUrl($iconUrl[0], $iconUrl[1]));
	} else {
		echo CHtml::link(CHtml::image(Yii::app()->baseUrl . $icon['icon'], $icon['title']),
			Yii::app()->createUrl($iconUrl[0]));
	}
}

} ?>

<p>
</div>

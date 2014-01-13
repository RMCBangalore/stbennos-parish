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
/* @var $this ProfileController */
/* @var $model User */

$this->breadcrumbs=array(
	'Profile',
);

$this->menu=array(
	array('label'=>'Change Password', 'url'=>array('changePassword')),
);
?>

<h1>My Profile (<?php echo $model->username; ?>)</h1>

<?php $success = Yii::app()->user->getFlash('success');
if (!empty($success)) {
	echo '<div class="flash-success">' . $success . "</div>";
} ?>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'username',
	),
)); ?>

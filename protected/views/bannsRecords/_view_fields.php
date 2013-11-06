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

function get_parish($parish) {
	if (ctype_digit($parish)) {
		return Parish::get()->name . ' (our parish)';
	} else {
		return $parish;
	}
}
?>

	<b><?php echo CHtml::encode($data->getAttributeLabel('groom_name')); ?>:</b>
	<?php echo CHtml::encode($data->groom_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('groom_parent')); ?>:</b>
	<?php echo CHtml::encode($data->groom_parent); ?>
	<br />

	<?php if (ctype_digit($data->groom_parish)) { ?>

	<b><?php echo CHtml::encode($data->getAttributeLabel('groom_parish')); ?>:</b>
	<?php echo get_parish($data->groom_parish); ?>
	<br />

	<b><?php echo 'Groom DOB' ?>:</b>
	<?php echo $data->groom()->dob; ?>
	<br />

	<b><?php echo 'Groom Baptism Date' ?>:</b>
	<?php echo $data->groom()->baptism_dt; ?>
	<br />

	<?php } else {?>

	<b><?php echo CHtml::encode($data->getAttributeLabel('groom_parish')); ?>:</b>
	<?php echo CHtml::encode($data->groom_parish); ?>
	<br />

	<?php } ?>

	<b><?php echo CHtml::encode($data->getAttributeLabel('bride_name')); ?>:</b>
	<?php echo CHtml::encode($data->bride_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bride_parent')); ?>:</b>
	<?php echo CHtml::encode($data->bride_parent); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bride_parish')); ?>:</b>
	<?php echo get_parish($data->bride_parish); ?>
	<br />


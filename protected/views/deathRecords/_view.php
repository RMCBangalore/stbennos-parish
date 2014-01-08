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
/* @var $this DeathRecordsController */
/* @var $data DeathRecord */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ref_no')); ?>:</b>
	<?php echo CHtml::encode($data->ref_no); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('death_dt')); ?>:</b>
	<?php echo CHtml::encode($data->death_dt); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cause')); ?>:</b>
	<?php echo CHtml::encode($data->cause); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fname')); ?>:</b>
	<?php echo CHtml::encode($data->fname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lname')); ?>:</b>
	<?php echo CHtml::encode($data->lname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('age')); ?>:</b>
	<?php echo CHtml::encode($data->age); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('profession')); ?>:</b>
	<?php echo CHtml::encode($data->profession); ?>
	<br >

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('buried_dt')); ?>:</b>
	<?php echo CHtml::encode($data->buried_dt); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('minister')); ?>:</b>
	<?php echo CHtml::encode($data->minister); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('burial_place')); ?>:</b>
	<?php echo CHtml::encode($data->burial_place); ?>
	<br />

	*/ ?>

</div>

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
/* @var $this BaptismRecordsController */
/* @var $data BaptismRecord */
?>

<div class="view">

<div class="fields">
	<div class="ident">
	<span class="head"><?php echo CHtml::link(CHtml::encode($data->name . ': #' . $data->id), array('view', 'id'=>$data->id)); ?></span>
	<br />

	<?php echo CHtml::encode('Ref '); ?>
	<span class="ref"><?php echo CHtml::encode('#'.$data->ref_no); ?></span>; 
	<span class="val"><?php echo CHtml::encode(isset($data->sex) ? FieldNames::value('sex', $data->sex) : ''); ?></span>
	</div>

	<div class="sacrament">
	<?php echo CHtml::encode('Born'); #data->getAttributeLabel('dob')); ?>:
	<span class="val"><?php echo CHtml::encode($data->dob); ?></span>
	<br />

	<?php echo CHtml::encode('Baptised'); ?>:
	<span class="val"><?php echo CHtml::encode($data->baptism_dt); ?></span>
	<br />

	<?php echo CHtml::encode('Father'); ?>:
	<span class="val"><?php echo CHtml::encode($data->fathers_name); ?></span>
	<br />

	<?php echo CHtml::encode('Mother'); ?>:
	<span class="val"><?php echo CHtml::encode($data->mothers_name); ?></span>
	</div>

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('mothers_name')); ?>:</b>
	<?php echo CHtml::encode($data->mothers_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('residence')); ?>:</b>
	<?php echo CHtml::encode($data->residence); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('godfathers_name')); ?>:</b>
	<?php echo CHtml::encode($data->godfathers_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('godmothers_name')); ?>:</b>
	<?php echo CHtml::encode($data->godmothers_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('minister')); ?>:</b>
	<?php echo CHtml::encode($data->minister); ?>
	<br />

	*/ ?>
	</div> <!-- fields -->

</div>

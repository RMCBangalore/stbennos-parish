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
/* @var $this SubscriptionController */
/* @var $data Subscription */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode('Family'); ?>:</b>
	<?php echo CHtml::encode($data->family->head_name . ' #' . $data->family_id); ?>
	<br />

	<b><?php echo CHtml::encode('From month'); ?>:</b>
	<?php echo date_format(new DateTime(implode("-",array($data->start_year,$data->start_month,1))), "M, Y"); ?>
	<br />


	<b><?php echo CHtml::encode('Till month'); ?>:</b>
	<?php echo date_format(new DateTime(implode("-",array($data->end_year,$data->end_month,1))), "M, Y"); ?>
	<br />

	<b><?php echo CHtml::encode('Monthly Amt') . ' &#8377;'; ?>:</b>
	<?php echo CHtml::encode($data->amount); ?>
	<br />

	<b><?php echo CHtml::encode('Total Amount') . ' &#8377;'; ?>:</b>
	<?php echo CHtml::encode($data->trans->amount); ?>
	<br />

</div>

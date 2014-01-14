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
/* @var $this MarriageRecordsController */
/* @var $data MarriageRecord */
?>

<div class="view">

<div class="fields">

	<div class="ident">
	<span class="head"><?php echo CHtml::link(
		CHtml::encode($data->groom_name . ' & ' . $data->bride_name),
		array('view', 'id'=>$data->id)); ?></span>
	<br />

	<span class="val"><?php echo CHtml::encode('#'.$data->id); ?></span>;
	<?php echo CHtml::encode('Ref '); ?>:
	<span class="val"><?php echo CHtml::encode('#'.$data->ref_no); ?></span>, 
	<?php echo CHtml::encode('Married'); ?>:
	<span class="val"><?php echo CHtml::encode($data->marriage_dt); ?></span>
	</div>

	<div class="sacrament">
	<?php echo CHtml::encode($data->getAttributeLabel('groom_dob')); ?>:</b>
	<span class="val"><?php echo CHtml::encode($data->groom_dob); ?></span>,
<?php /*
	<b><?php 
	echo CHtml::encode($data->getAttributeLabel('groom_status')); ?>:</b>
	<?php echo CHtml::encode($data->groom_status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('groom_rank_prof')); ?>:</b>
	<?php echo CHtml::encode($data->groom_rank_prof); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('groom_fathers_name')); ?>:</b>
	<?php echo CHtml::encode($data->groom_fathers_name); ?>
	<br />

	<?php 
	<b><?php echo CHtml::encode($data->getAttributeLabel('groom_mothers_name')); ?>:</b>
	<?php echo CHtml::encode($data->groom_mothers_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('groom_residence')); ?>:</b>
	<?php echo CHtml::encode($data->groom_residence); ?>
	<br />
*/ ?>
	<?php echo CHtml::encode('Bride'); ?>:
	<span class="val"><?php echo CHtml::encode($data->bride_dob); ?></span>
	</div>

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('bride_status')); ?>:</b>
	<?php echo CHtml::encode($data->bride_status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bride_rank_prof')); ?>:</b>
	<?php echo CHtml::encode($data->bride_rank_prof); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bride_fathers_name')); ?>:</b>
	<?php echo CHtml::encode($data->bride_fathers_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bride_mothers_name')); ?>:</b>
	<?php echo CHtml::encode($data->bride_mothers_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bride_residence')); ?>:</b>
	<?php echo CHtml::encode($data->bride_residence); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('banns_licence')); ?>:</b>
	<?php echo CHtml::encode($data->banns_licence); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('minister')); ?>:</b>
	<?php echo CHtml::encode($data->minister); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('witness1')); ?>:</b>
	<?php echo CHtml::encode($data->witness1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('witness2')); ?>:</b>
	<?php echo CHtml::encode($data->witness2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('remarks')); ?>:</b>
	<?php echo CHtml::encode($data->remarks); ?>
	<br />

	*/ ?>

</div><!-- fields -->
</div><!-- view -->

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
/* @var $this BannsRecordsController */
/* @var $data BannsRecord */

?>

<div class="view">

<div class="fields">

	<div class="ident">
	<span class="head">
	<?php echo CHtml::link(CHtml::encode($data->groom_name . ' & ' . $data->bride_name), array('view', 'id'=>$data->id)); ?>
	</span>
	</div>

	<div class="field">
	<?php echo CHtml::encode($data->getAttributeLabel('groom_parent')); ?>:
	<span class="val"><?php echo CHtml::encode($data->groom_parent); ?></span>
	<br />

	<?php if (ctype_digit($data->groom_parish)) { $local = 'groom' ?>

	<?php echo CHtml::encode($data->getAttributeLabel('groom_parish')); ?>:
	<span class="val"><?php echo BannsRecord::get_parish($data->groom_parish); ?></span>
	<br />

	<?php echo 'Groom DOB' ?>:
	<span class="val"><?php echo $data->groom()->dob; ?></span>
	<br />

	<?php echo 'Groom Baptism Date' ?>:
	<span class="val"><?php echo $data->groom()->baptism_dt; ?></span>
	<br />

	<?php } else {?>

	<?php echo CHtml::encode($data->getAttributeLabel('groom_parish')); ?>:
	<span class="val"><?php echo CHtml::encode($data->groom_parish); ?></span>
	<br />

	<?php } ?>

	<?php echo CHtml::encode($data->getAttributeLabel('bride_parent')); ?>:
	<span class="val"><?php echo CHtml::encode($data->bride_parent); ?></span>
	<br />

	<?php echo CHtml::encode($data->getAttributeLabel('bride_parish')); ?>:
	<span class="val"><?php echo BannsRecord::get_parish($data->bride_parish); ?></span>
	<br />

	<?php if (ctype_digit($data->bride_parish)) {

		if (isset($local)) {
			$local = 'both';
		} else {
			$local = 'bride';
		}

		echo 'Bride DOB: ';
		echo '<span class="val">'.CHtml::encode($data->bride()->dob).'</span>';
		echo '<br />';

		echo 'Bride Baptism Date: ';
		echo '<span class="val">' . CHtml::encode($data->bride()->baptism_dt).'</span>';
		echo '<br />';

	} ?>
	</div>

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('banns_dt1')); ?>:</b>
	<?php echo CHtml::encode($data->banns_dt1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('banns_dt2')); ?>:</b>
	<?php echo CHtml::encode($data->banns_dt2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('banns_dt3')); ?>:</b>
	<?php echo CHtml::encode($data->banns_dt3); ?>
	<br />

	*/ ?>

	<?php if (isset($local) and 'both' != $local) {
		echo CHtml::link('Create Request', array('bannsRequest/create', 'bid' => $data->id));
		echo '<br />';
		echo CHtml::link('Create Response', array('bannsResponse/create', 'bid' => $data->id));
		echo '<br />';
		echo CHtml::link('Create No Impediment Letter', array('noImpedimentLetter/create', 'bid' => $data->id));
		echo '<br />';
	} ?>

</div> <!-- fields -->

</div> <!-- view -->

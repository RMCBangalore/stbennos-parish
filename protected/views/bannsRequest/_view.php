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
/* @var $this BannsRequestController */
/* @var $data BannsRequest */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />
	
	<?php echo $this->renderPartial('../bannsRecords/_view_fields', array('data' => $data->banns)); ?>

	<b><?php echo CHtml::encode($data->getAttributeLabel('req_dt')); ?>:</b>
	<?php echo CHtml::encode($data->req_dt); ?>
	<br />

	<?php echo CHtml::link('View Record', array('bannsRecords/view', 'id'=>$data->banns_id)) . ' | ';
	echo CHtml::link('Download Letter', array('viewCert', 'id' => $data->id), array('target' => '_blank')) ?>

</div>

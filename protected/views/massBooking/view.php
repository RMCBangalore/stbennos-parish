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
/* @var $this MassBookingController */
/* @var $model MassBooking */

$this->breadcrumbs=array(
	'Mass Bookings'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List MassBooking', 'url'=>array('index')),
	array('label'=>'Create MassBooking', 'url'=>array('create')),
	array('label'=>'Update MassBooking', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete MassBooking', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage MassBooking', 'url'=>array('admin')),
);
?>

<h1>View MassBooking #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'mass_dt',
		'mass_id',
		'booked_by',
		'intention',
		'trans_id',
	),
)); ?>

<?php echo CHtml::link('Download Receipt', array('viewCert', 'id'=>$model->id), array('target' => '_blank')) ?>


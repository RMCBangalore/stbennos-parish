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
/* @var $this DeathCertificateController */
/* @var $model DeathCertificate */

$this->breadcrumbs=array(
       'Certificates' => array('site/page', 'view' => 'certificates'),
	'Death Certificates'=>array('index'),
	$model->id,
);

$this->menu=array(
 	array('label'=>'Create DeathRecord', 'url'=>array('/deathRecords/create')),
	array('label'=>'List DeathCertificate', 'url'=>array('index')),
	array('label'=>'Update DeathCertificate', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete DeathCertificate', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage DeathCertificate', 'url'=>array('admin')),
);
?>

<h1>View DeathCertificate #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'death_id',
		'cert_dt',
	),
)); ?>

<?php echo CHtml::link('Download Certificate', array('viewCert', 'id' => $model->id), array('target' => '_blank')); ?>


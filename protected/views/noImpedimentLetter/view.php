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
/* @var $this NoImpedimentLetterController */
/* @var $model NoImpedimentLetter */

$this->breadcrumbs=array(
       'Certificates' => array('site/page', 'view' => 'certificates'),
	'No Impediment Letters'=>array('index'),
	$model->id,
);

$this->menu=array(
 	array('label'=>'Create BannsRecord', 'url'=>array('/bannsRecords/create')),
	array('label'=>'List NoImpedimentLetter', 'url'=>array('index')),
	array('label'=>'Update NoImpedimentLetter', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete NoImpedimentLetter', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage NoImpedimentLetter', 'url'=>array('admin')),
);
?>

<h1>View NoImpedimentLetter #<?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('../bannsRecords/_view_fields', array('data' => $model->banns)); ?>

<b><?php echo CHtml::encode($model->getAttributeLabel('letter_dt')); ?>:</b>
<?php echo CHtml::encode($model->letter_dt); ?>
<br />

<?php echo CHtml::link('Download Letter', array('viewCert', 'id' => $model->id), array('target' => '_blank')) ?>

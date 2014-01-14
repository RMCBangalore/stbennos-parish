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
/* @var $this BaptismCertificateController */
/* @var $model BaptismCertificate */

$this->breadcrumbs=array(
       'Certificates' => array('site/page', 'view' => 'certificates'),
	'Baptism Certificates'=>array('index'),
	$model->id,
);

$this->menu=array(
 	array('label'=>'Create BaptismRecord', 'url'=>array('/baptismRecords/create')),
	array('label'=>'List BaptismCertificate', 'url'=>array('index')),
	array('label'=>'Delete BaptismCertificate', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage BaptismCertificate', 'url'=>array('admin')),
);
?>

<h1>View BaptismCertificate #<?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('../baptismRecords/_view_fields', array('data' => $model->baptism)); ?>

<b><?php echo CHtml::encode($model->getAttributeLabel('cert_dt')); ?>:</b>
<?php echo CHtml::encode($model->cert_dt); ?>
<br />

	<?php echo CHtml::link('View Record', array('/baptismRecords/view', 'id' => $model->baptism_id)) . ' | ' .
	CHtml::link('Download Certificate', array('viewCert', 'id' => $model->id), array('target' => '_blank')) ?>


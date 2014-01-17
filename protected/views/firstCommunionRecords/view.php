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
/* @var $this FirstCommunionRecordsController */
/* @var $model FirstCommunionRecord */

$this->breadcrumbs=array(
       'Registers' => array('site/page', 'view' => 'registers'),
	'First Communion Records'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List First Communion Record', 'url'=>array('index')),
	array('label'=>'Create First Communion Record', 'url'=>array('create')),
	array('label'=>'Update First Communion Record', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete First Communion Record', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage First Communion Record', 'url'=>array('admin')),
	array('label'=>'View Certificates', 'url'=>array('/firstCommunionCertificate/byRecord', 'id'=>$model->id))
);
?>

<h1><?php echo $model->name ?>: #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ref_no',
		'communion_dt',
		'church',
	),
)); ?>

<?php echo CHtml::link('Edit', array('update', 'id'=>$model->id));
if ($model->firstCommunionCerts) {
	echo ' | ' . CHtml::link('View Certificates', array('firstCommunionCertificate/byRecord', 'id' => $model->id));
}
	$cert = new FirstCommunionCertificate;
	$form = $this->beginWidget('CActiveForm', array(
		'id'=>'first-communion-certificate-form',
		'action'=>array('/firstCommunionCertificate/create'),
		'enableAjaxValidation' => false,
	));
	echo $form->hiddenField($cert,'first_comm_id',array('value'=>$model->id));
	echo $form->hiddenField($cert,'cert_dt',array('value'=>date('d/m/Y')));
	echo CHtml::imageButton(Yii::app()->createUrl("/images/create-cert.jpg"), array('value'=>'Create Certificate'));
	$this->endWidget();
?>


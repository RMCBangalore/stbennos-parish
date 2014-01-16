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
/* @var $this ConfirmationRecordsController */
/* @var $model ConfirmationRecord */

$this->breadcrumbs=array(
       'Registers' => array('site/page', 'view' => 'registers'),
	'Confirmation Records'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List ConfirmationRecord', 'url'=>array('index')),
	array('label'=>'Create ConfirmationRecord', 'url'=>array('create')),
	array('label'=>'Update ConfirmationRecord', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ConfirmationRecord', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ConfirmationRecord', 'url'=>array('admin')),
	array('label'=>'View Certificates', 'url'=>array('/confirmationCertificate/byRecord', 'id'=>$model->id))
);
?>

<h1><?php echo CHtml::encode($model->name); ?>: #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ref_no',
		'confirmation_dt',
		'church',
		'dob',
		'baptism_dt',
		'baptism_place',
		'parents_name',
		'godparent_name',
		'residence',
		'minister',
	),
)); ?>

<?php echo CHtml::link('Edit', array('update', 'id' => $model->id));
if ($model->confirmationCerts) { echo ' | ' . CHtml::link('View Certificates', array('confirmationCertificate/byRecord', 'id' => $model->id)); }
	$cert = new ConfirmationCertificate;
	$form = $this->beginWidget('CActiveForm', array(
		'id'=>'confirmation-certificate-form',
		'action'=>array('/confirmationCertificate/create'),
		'enableAjaxValidation' => false,
	));
	echo $form->hiddenField($cert,'confirmation_id',array('value'=>$model->id));
	echo $form->hiddenField($cert,'cert_dt',array('value'=>date('d/m/Y')));
	echo CHtml::imageButton(Yii::app()->createUrl("/images/create-cert.jpg"));
	$this->endWidget();
?>


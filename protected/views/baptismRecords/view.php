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
/* @var $this BaptismRecordsController */
/* @var $model BaptismRecord */

$this->breadcrumbs=array(
	'Registers' => array('site/page', 'view' => 'registers'),
	'Baptism Records'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List BaptismRecord', 'url'=>array('index')),
	array('label'=>'Create BaptismRecord', 'url'=>array('create')),
	array('label'=>'Update BaptismRecord', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete BaptismRecord', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage BaptismRecord', 'url'=>array('admin')),
	array('label'=>'View Certificates', 'url'=>array('/baptismCertificate/byRecord', 'id'=>$model->id)),
);
?>

<h1><?php echo CHtml::encode($model->name . ': '); ?> #<?php echo $model->id; ?></h1>

<?php $this->renderPartial('_view_main', array('data' => $model));

$cert = new BaptismCertificate;
$form = $this->beginWidget('CActiveForm', array(
	'id'=>'baptism-certificate-form',
	'action'=>array('/baptismCertificate/create'),
	'enableAjaxValidation' => false,
));
echo $form->hiddenField($cert,'baptism_id',array('value'=>$model->id));
echo $form->hiddenField($cert,'cert_dt',array('value'=>date('d/m/Y')));
echo CHtml::imageButton(Yii::app()->createUrl("/images/create-cert.jpg"), array('value'=>'Create Certificate'));
$this->endWidget();

/*$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'dob',
		'baptism_dt',
		'name',
		'sex',
		'fathers_name',
		'mothers_name',
		'residence',
		'godfathers_name',
		'godmothers_name',
		'minister',
	),
)); i*/ ?>

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
/* @var $this SubscriptionController */
/* @var $model Subscription */

$this->breadcrumbs=array(
	'Subscriptions'=>array('index'),
	$model->id,
);

if (!isset($family)) {
	$family = $model->family;
}

$this->menu=array(
	array('label'=>'List Subscription', 'url'=>array('index','fid'=>$family->id)),
	array('label'=>'Create Subscription', 'url'=>array('create','fid'=>$family->id)),
	array('label'=>'Update Subscription', 'url'=>array('update', 'id'=>$model->id,'fid'=>$family->id)),
	array('label'=>'Delete Subscription', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id,'fid'=>$family->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Subscription', 'url'=>array('admin')),
);
?>

<h1>View Subscription #<?php echo $model->id; ?></h1>

<?php
$NF = Yii::app()->numberFormatter;
$cur = Parish::get()->currency;
$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		array(
			'label' => 'Family&nbsp;(Head&nbsp;name,&nbsp;id)',
			'name' => 'family_id',
			'value' => $model->family->head_name ." #" . $model->family->id
		),
		array(
			'label' => 'From&nbsp;month',
			'name' => 'start_year',
			'value' => date_format(new DateTime(implode("-",array($model->start_year,$model->start_month,1))), "M, Y"),
		),
		array(
			'label' => 'Till&nbsp;month',
			'name' => 'end_year',
			'value' => date_format(new DateTime(implode("-",array($model->end_year,$model->end_month,1))), "M, Y"),
		),
		array(
			'label' => 'Monthly Amt',
			'value' => $NF->formatCurrency($model->amount, $cur),
		),
		array(
			'label' => 'Total Amount',
			'value' => $NF->formatCurrency($model->trans->amount, $cur),
		),
		'paid_by',
	),
)); ?>

<?php echo CHtml::link('Download Receipt', array('viewRect', 'id' => $model->id), array('target' => '_blank')) ?>

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
/* @var $this FieldValueController */
/* @var $model FieldValues */

$lbl = $_GET['type'] ? ucwords(implode(' ', explode('_', $_GET['type']))) : 'Field Values';

$lbls = preg_match('/s$/', $lbl) ? $lbl : "${lbl}s";

$this->breadcrumbs=array(
	'Admin' => array('site/page', 'view' => 'admin'),
	$lbls=>array('index', 'type' => $_GET['type']),
	$model->name,
);

if (isset($_GET['type'])) {
	$type = $_GET['type'];
} else {
	$type = $model->field->name;
}

$this->menu=array(
	array('label'=>'List FieldValues', 'url'=>array('index', 'type' => $type)),
	array('label'=>'Create FieldValues', 'url'=>array('create', 'type' => $type)),
	array('label'=>'Update FieldValues', 'url'=>array('update', 'id'=>$model->id, 'type' => $type)),
	array('label'=>'Delete FieldValues', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage FieldValues', 'url'=>array('admin', 'type' => $type)),
);
?>

<h1>View FieldValues #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'field_id',
		'id',
		'name',
		'code',
		'pos',
	),
)); ?>

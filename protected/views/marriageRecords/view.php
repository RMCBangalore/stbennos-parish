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
/* @var $this MarriageRecordsController */
/* @var $model MarriageRecord */

$this->breadcrumbs=array(
       'Registers' => array('site/page', 'view' => 'registers'),
	'Marriage Records'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List MarriageRecord', 'url'=>array('index')),
	array('label'=>'Create MarriageRecord', 'url'=>array('create')),
	array('label'=>'Update MarriageRecord', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete MarriageRecord', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage MarriageRecord', 'url'=>array('admin')),
	array('label'=>'View Certificates', 'url'=>array('/marriageCertificate/byRecord', 'id'=>$model->id))
);
?>

<h1>View Marriage Record #<?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_view_main', array('model' => $model, 'data' => $model, 'now' => $now)); /*
$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'marriage_dt',
		'groom_name',
		'groom_dob',
		'groom_status',
		'groom_rank_prof',
		'groom_fathers_name',
		'groom_mothers_name',
		'groom_residence',
		'bride_name',
		'bride_dob',
		'bride_status',
		'bride_rank_prof',
		'bride_fathers_name',
		'bride_mothers_name',
		'bride_residence',
		'banns_licence',
		'minister',
		'witness1',
		'witness2',
		'remarks',
	),
)); */ ?>

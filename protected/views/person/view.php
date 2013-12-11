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
/* @var $this PersonController */
/* @var $model People */

$this->breadcrumbs=array(
	'Peoples'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List People', 'url'=>array('index')),
	array('label'=>'Create People', 'url'=>array('create')),
	array('label'=>'Update People', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete People', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage People', 'url'=>array('admin')),
);
?>

<h1><?php echo $model->fullname() . ': #' . $model->id; ?></h1>

<?php

	if ($model->photo) {
		$src = Yii::app()->request->baseUrl . '/images/members/' . $model->photo;
		list($width, $height) = getimagesize("./images/members/" . $model->photo);
		$label = 'Update Photo';
	} else {
		$sex = strtolower(FieldNames::value('sex', $model->sex));
		$photo_path = "/images/member-photo-$sex.jpg";
		$src = Yii::app()->request->baseUrl . $photo_path;
		list($width, $height) = getimagesize(".$photo_path");
		$label = 'Upload Photo';
	}
	$alt = $model->fname . "'s photo";
	echo CHtml::image($src, $alt, array('width' => $width, 'height' => $height));
	echo "<p>";
	echo CHtml::link($label, array('photo', 'id'=>$model->id));
	echo "</p>";

	foreach(array('sex', 'domicile_status', 'education', 'lang_pri', 'lang_lit', 'lang_edu', 'rite') as $field) {
		if ($model->$field) {
			$key = $field;
			if (preg_match('/^lang/', $field)) {
				$key = 'languages';
			}
			$model->$field = FieldNames::value($key, $model->$field);
		}
	}

$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'mid',
		'fname',
		'lname',
		'sex',
		'domicile_status',
		'dob',
		'education',
		'profession',
		'occupation',
		'mobile',
		'email',
		'lang_pri',
		'lang_lit',
		'lang_edu',
		'rite',
		'baptism_dt',
		'baptism_church',
		'baptism_place',
		'god_parents',
		'first_comm_dt',
		'confirmation_dt',
		'marriage_dt',
		'cemetery_church',
		'family_id',
	),
)); ?>

<?php echo CHtml::link('Create Certificate', array('membershipCertificate/create', 'id' => $model->id)) ?>

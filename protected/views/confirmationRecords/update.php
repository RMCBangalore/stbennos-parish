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
/* @var $this ConfirmationRecordsController */
/* @var $model ConfirmationRecord */

$this->breadcrumbs=array(
       'Registers' => array('site/page', 'view' => 'registers'),
	'Confirmation Records'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ConfirmationRecord', 'url'=>array('index')),
	array('label'=>'Create ConfirmationRecord', 'url'=>array('create')),
	array('label'=>'View ConfirmationRecord', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ConfirmationRecord', 'url'=>array('admin')),
	array('label'=>'View Certificates', 'url'=>array('/confirmationCertificate/byRecord', 'id'=>$model->id))
);
?>

<h1>Update ConfirmationRecord <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
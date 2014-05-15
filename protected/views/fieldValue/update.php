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

if (isset($_GET['type'])) {
	$type = $_GET['type'];
} else {
	$type = $model->field->name;
}

$lbl = ucwords(implode(' ', explode('_', $type)));
if (preg_match('/es$/', $lbl)) {
	if (preg_match('/ses$/', $lbl)) {
		$lbl = preg_replace('/es$/', '', $lbl);
	} else {
		$lbl = preg_replace('/s$/', '', $lbl);
	}
}

$lbls = preg_match('/s$/', $lbl) ?
	(preg_match('/[aoui]s$/', $lbl) ? "${lbl}es" : $lbl) :
	"${lbl}s";

$this->breadcrumbs=array(
	'Admin' => array('site/page', 'view' => 'admin'),
	$lbls=>array('index', 'type' => $_GET['type']),
	$model->name=>array('view','id'=>$model->id, 'type' => $_GET['type']),
	'Update',
);

$this->menu=array(
	array('label'=>"List $lbls", 'url'=>array('index', 'type' => $_GET['type'])),
	array('label'=>"Create $lbl", 'url'=>array('create', 'type' => $_GET['type'])),
	array('label'=>"View $lbl", 'url'=>array('view', 'id'=>$model->id, 'type' => $_GET['type'])),
	array('label'=>"Manage $lbls", 'url'=>array('admin', 'type' => $_GET['type'])),
);
?>

<h1>Update <?php echo $lbl . " " . $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

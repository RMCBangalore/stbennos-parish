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
/* @var $this VisitController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Families'=>array('index'),
	$fid=>array('view','id'=>$fid),
	'Visits',
);

$this->menu=array(
	array('label'=>'Create Visits', 'url'=>array('/visit/create','fid'=>$fid)),
	array('label' => 'View Family', 'url'=>array('view', 'id' => $fid)),
);
?>

<h1>Visits to Family #<?php echo $fid ?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'../visit/_view',
)); ?>

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
/* @var $this IndividualController */
/* @var $model Individuals */

$this->breadcrumbs=array(
	'Individuals'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Update Individual', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Survey Individual', 'url'=>array('survey', 'id'=>$model->id)),
	array('label'=>'Subscriptions', 'url'=>array('/family/subscriptions', 'id'=>$model->id)),
	array('label'=>'House Visits', 'url'=>array('visits', 'id'=>$model->id))
);
?>

<h1><?php echo $model->head()->fullname() . ": #" . $model->id; ?></h1>

<?php
	echo '<table><tr><td>';
	$unit = $model->unit;
	if ($unit->photo) {
		$src = Yii::app()->request->baseUrl . '/images/families/' . $unit->photo;
		list($width, $height) = getimagesize("./images/families/" . $unit->photo);
		$label = 'Update Photo';
	} else {
		$photo_path = '/images/family-photo.jpg';
		$src = Yii::app()->request->baseUrl . $photo_path;
		list($width, $height) = getimagesize(".$photo_path");
		$label = 'Upload Photo';
	}
	$alt = "Individual photo";
	echo CHtml::image($src, $alt, array('width' => $width, 'height' => $height));
	echo CHtml::link($label, array('photo', 'id'=>$model->id));
	echo '</td><td>';

	if (isset($unit->gmap_url)) {
		$gmurl = $unit->gmap_url;
		echo "<iframe width=\"300\" height=\"275\" frameborder=\"0\" scrolling=\"no\"" .
			" marginheight=\"0\" marginwidth=\"0\" src=\"$gmurl\"></iframe>" .
			"<br /><small><a href=\"$gmurl\" style=\"color:#0000FF;text-align:left\">" .
			"View Larger Map</a></small>";
		echo '<br />' . CHtml::link('Change location', array('locate', 'id' => $model->id));
	} else {
		$src = Yii::app()->request->baseUrl . '/images/google-map.jpg';
		$dim = array('width' => 300, 'height' => 283);
		$alt = "Google map";
		echo CHtml::image($src, $alt, $dim);
		echo CHtml::link('Locate on Google maps', array('locate', 'id' => $model->id));
	}

	echo '</td></tr></table>';

	$member = $model->member;
	$tabs = array(
        'tab1'=>array(
            'title'=>'Unit Data',
            'view'=>'_view_detail',
            'data'=>array(
                'data'=>$model,
            ),
        ),
        'tab2'=>array(
            'title'=>'Member',
            'view'=>'../person/_view',
            'data'=>array(
				'person'=>'member',
                'data'=>$member,
            ),
        ),
	);
?>

    <?php $this->widget('CTabView',array(
    'tabs'=>$tabs
	)); ?>


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
/* @var $this MassScheduleController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Admin' => array('site/page', 'view' => 'admin'),
	'Mass Schedules',
);

$this->menu=array(
	array('label'=>'Create MassSchedule', 'url'=>array('create')),
	array('label'=>'Manage MassSchedule', 'url'=>array('admin')),
);

$this->widget('application.extensions.fancybox.EFancyBox', array(
    'target'=>'a[rel=gallery]', 'config'=>array(),
));

Yii::app()->clientScript->registerScript('massAjax', "
function set_select() {
	$('#mass-schedule-form').submit(function() {
		$.post($(this).attr('action'), $(this).serialize());
		$.fancybox.close();
		$.get('" . Yii::app()->request->baseUrl . "/massSchedule/index', function(data) {
			$('#mass-schedule').html(data);
			set_delete();
		} );
		return false;
	} );
}

function set_delete() {
	$('a.del').click(function() {
		$.post($(this).attr('href'));
		$.get('" . Yii::app()->request->baseUrl . "/massSchedule/index', function(data) {
			$('#mass-schedule').html(data);
			set_delete();
		} );
		return false;
	} );
}

$('#add-mass').fancybox( {
	'onComplete': function() {
		set_select();
		set_delete();
	}
} );

set_delete();

");

?>

<form style="float: right">
<?php if (Yii::app()->user->checkAccess('MassSchedule.Create')) {
	echo CHtml::link('Add Mass', array('/massSchedule/create'), array('id' => 'add-mass')); 
} ?>
</form>

<h1>Mass Schedule</h1>

<div id="mass-schedule">
<?php $this->renderPartial('schedule-table', array('schedule' => $schedule)); ?>
</div>


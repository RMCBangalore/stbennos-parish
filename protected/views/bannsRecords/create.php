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
/* @var $this BannsRecordsController */
/* @var $model BannsRecord */

$this->breadcrumbs=array(
       'Registers' => array('site/page', 'view' => 'registers'),
	'Banns Records'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List BannsRecord', 'url'=>array('index')),
	array('label'=>'Manage BannsRecord', 'url'=>array('admin')),
);
?>

<h1>Create BannsRecord</h1>

<?php /*
if (isset($members)) {
	echo $this->renderPartial('_sel_member', array('model'=>$model, 'members' => $members));
} elseif (isset($local)) {
	$parms = array('model'=>$model, 'local' => $local);
	if ('both' == $local) {
		$parms['bride'] = $bride;
		$parms['groom'] = $groom;
	} else {
		$parms[$local] = ${$local};
	}
	echo $this->renderPartial('_form', $parms);
} else {
	echo $this->renderPartial('_sel_local', array('model'=>$model));
}
 */
	echo $this->renderPartial('_form_ajax', array('model' => $model));
 ?>

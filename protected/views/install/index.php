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
/* @var $this InstallController */

$this->breadcrumbs=array(
	'Install',
);

$baseUrl = Yii::app()->baseUrl; 
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile($baseUrl.'/js/jquery.min.js');
$cs->registerScriptFile($baseUrl . '/js/db-setup-progress.js');

?>

<style>
div.license {
	height: 400px;
	overflow: auto;
}
</style>

<h1>Welcome to Alive Parish Software</h1>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'db-setup-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p>Alive Parish Software is licensed under the GNU GPL version 3 and guarantees the <a href="http://www.gnu.org/philosophy/free-sw">Four Freedoms</a>:</p>
	</p>

	<div class="license">
		<p><?php $this->renderPartial('gpl') ?></p>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Accept', array('name' => 'accept')); ?>
		<?php echo CHtml::submitButton('Cancel', array('onClick' => 'return confirm("Are you sure you want to cancel?")')) ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

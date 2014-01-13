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
?>
<h1>Welcome to Alive Parish Software</h1>

<p>
If you are seeing this page, it means you are ready to install Alive Parish Software!<br /> Doing this is as simple as 1, 2, 3.
</p>

<h2>Step 1: Configure your database</h2>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'db-setup-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php $err = Yii::app()->user->getFlash('error');
	if (!empty($err)) {
		echo '<div class="errorSummary">' . $err . '</div>';
	} ?>

	<div class="row">
	<span class="leftHalf">
		<?php echo CHtml::label('Database Type', 'driver'); ?>
		<?php echo CHtml::textField('driver', 'mysql', array('readonly' => true, 'size'=>15,'maxlength'=>30)); ?>
	</span>
	<span class="rightHalf">
		<?php echo CHtml::label('Database Name', 'dbname', array('required'=>empty($dbname))); ?>
		<?php echo CHtml::textField('dbname', $dbname, array('readonly' => !empty($dbname), 'size'=>15,'maxlength'=>30)); ?>
	</span>
	</div>

	<div class="row">
		<?php echo CHtml::label('Database Username', 'dbuser', array('required'=>true)); ?>
		<?php echo CHtml::textField('dbuser', '', array('size'=>15,'maxlength'=>30)); ?>
	</div>

	<div class="row">
	<span class="leftHalf">
		<?php echo CHtml::label('Database Password', 'dbpass', array('required'=>true)); ?>
		<?php echo CHtml::passwordField('dbpass', '', array('size'=>15,'maxlength'=>30)); ?>
	</span>
	<span class="rightHalf">
		<?php echo CHtml::label('Re-enter Password', 'reenter_pass', array('required'=>true)); ?>
		<?php echo CHtml::passwordField('reenter_pass', '', array('size'=>15,'maxlength'=>30)); ?>
	</span>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Next'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

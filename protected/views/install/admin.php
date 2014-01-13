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

<h1>Setup User Accounts</h1>

<p>You've successfully configured your database. Next, create some accounts to manage your installation.
</p>

<h2>Step 2: Setup Accounts</h2>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'parish-config-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php $err = Yii::app()->user->getFlash('error');
	if (!empty($err)) {
		echo '<div class="errorSummary">' . $err . '</div>';
	} ?>

	<table>
	<tr><td>
	<div class="row">
		<?php echo CHtml::label('Admin Username', 'adm_username', array('required'=>true)); ?>
		<?php echo CHtml::textField('adm[username]', '', array('id' => 'adm_username','size'=>15,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo CHtml::label('Admin Password', 'adm_password', array('required'=>true)); ?>
		<?php echo CHtml::passwordField('adm[password]', '', array('id' => 'adm_password','size'=>15,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo CHtml::label('Re-enter Admin Password', 'reenter_adm_password', array('required'=>true)); ?>
		<?php echo CHtml::passwordField('reenter_adm_password', '', array('size'=>15,'maxlength'=>30)); ?>
	</div>
	</td>
	<td>
	<div class="row">
		<?php echo CHtml::label('Pastor Username', 'pastor_username', array('required'=>false)); ?>
		<?php echo CHtml::textField('pastor[username]', '', array('id' => 'pastor_username','size'=>15,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo CHtml::label('Pastor Password', 'pastor_password', array('required'=>false)); ?>
		<?php echo CHtml::passwordField('pastor[password]', '', array('id' => 'pastor_password','size'=>15,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo CHtml::label('Re-enter Pastor Password', 'reenter_pastor_password', array('required'=>false)); ?>
		<?php echo CHtml::passwordField('reenter_pastor_password', '', array('size'=>15,'maxlength'=>30)); ?>
	</div>
	</td>
	<td>
	<div class="row">
		<?php echo CHtml::label('Staff Username', 'staff_username', array('required'=>false)); ?>
		<?php echo CHtml::textField('staff[username]', '', array('id' => 'staff_username','size'=>15,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo CHtml::label('Staff Password', 'staff_password', array('required'=>false)); ?>
		<?php echo CHtml::passwordField('staff[password]', '', array('id' => 'staff_password','size'=>15,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo CHtml::label('Re-enter Staff Password', 'reenter_staff_password', array('required'=>false)); ?>
		<?php echo CHtml::passwordField('reenter_staff_password', '', array('size'=>15,'maxlength'=>30)); ?>
	</div>
	</td></tr>
	</table>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Next'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

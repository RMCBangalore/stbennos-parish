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
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'parish-config-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

	<?php $err = Yii::app()->user->getFlash('error');
	if (!empty($err)) {
		echo '<div class="errorSummary">' . $err . '</div>';
	} 
	?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
	<span class="leftHalf">
		<?php echo $form->labelEx($model, 'name'); ?>
		<?php echo $form->textField($model, 'name', array('size'=>15,'maxlength'=>30)); ?>
		<?php echo $form->error($model, 'name') ?>
	</span>
	<span class="rightHalf">
		<?php echo CHtml::label('Parish Logo', 'parish_logo'); ?>
		<?php echo CHtml::fileField('Parish[logo]', '', array('id'=>'parish_logo','size'=>15,'maxlength'=>30)); ?>
	</span>
	</div>

	<div class="row">
	<span class="leftHalf">
		<?php echo $form->labelEx($model, 'est_year'); ?>
		<?php echo $form->textField($model, 'est_year', array('size'=>15,'maxlength'=>30)); ?>
		<?php echo $form->error($model, 'est_year') ?>
		<?php echo $form->labelEx($model, 'currency'); ?>
		<?php echo $form->dropDownList($model, 'currency', Yii::app()->params['currencies'], array('prompt'=>'--- Select one ---')); ?>
		<?php echo $form->error($model, 'currency') ?>
	</span>
	<span class="rightHalf">
		<?php echo $form->labelEx($model, 'address'); ?>
		<?php echo $form->textArea($model, 'address', array('rows'=>4,'cols'=>30)); ?>
		<?php echo $form->error($model, 'address') ?>
	</span>
	</div>

	<div class="row">
	<span class="leftHalf">
		<?php echo $form->labelEx($model, 'city'); ?>
		<?php echo $form->textField($model, 'city', array('size'=>15,'maxlength'=>30)); ?>
		<?php echo $form->error($model, 'city') ?>
	</span>
	<span class="rightHalf">
		<?php echo $form->labelEx($model, 'pin'); ?>
		<?php echo $form->textField($model, 'pin', array('size'=>15,'maxlength'=>30)); ?>
		<?php echo $form->error($model, 'pin') ?>
	</span>
	</div>

	<div class="row">
	<span class="leftHalf">
		<?php echo $form->labelEx($model, 'phone'); ?>
		<?php echo $form->textField($model, 'phone', array('size'=>15,'maxlength'=>30)); ?>
		<?php echo $form->error($model, 'phone') ?>
	</span>
	<span class="rightHalf">
		<?php echo $form->labelEx($model, 'website'); ?>
		<?php echo $form->textField($model, 'website', array('size'=>15,'maxlength'=>30)); ?>
		<?php echo $form->error($model, 'website') ?>
	</span>
	</div>

	<div class="row">
	<span class="leftHalf">
		<?php echo $form->labelEx($model, 'mass_book_basic'); ?>
		<?php echo $form->textField($model, 'mass_book_basic', array('size'=>15,'maxlength'=>30)); ?>
		<?php echo $form->error($model, 'mass_book_basic') ?>
	</span>
	<span class="rightHalf">
		<?php echo $form->labelEx($model, 'mass_book_sun'); ?>
		<?php echo $form->textField($model, 'mass_book_sun', array('size'=>15,'maxlength'=>30)); ?>
		<?php echo $form->error($model, 'mass_book_sun') ?>
	</span>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->


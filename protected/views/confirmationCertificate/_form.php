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
/* @var $this ConfirmationCertificatesController */
/* @var $model ConfirmationCertificate */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'confirmation-certificate-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->hiddenField($model, 'confirmation_id', array('value' => $confirmation->id)); ?>

	<?php echo $this->renderPartial('../confirmationRecords/_view_fields', array('data' => $confirmation)) ?>

	<div class="row">
		<?php echo $form->labelEx($model,'cert_dt'); ?>
		<?php echo $form->textField($model,'cert_dt',array('readonly'=>1,'value'=>date_format(new DateTime(),'d/m/Y'))); ?>
		<?php echo $form->error($model,'cert_dt'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

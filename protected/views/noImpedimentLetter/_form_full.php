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

<div class="view">

<?php echo $this->renderPartial('../bannsRecords/_view_fields', array('data' => $data)); ?>

<div class="form">

<?php $form = $this->beginWidget('CActiveForm', array(
	'id'=>'banns-request-form',
	'enableAjaxValidation'=>false,
)); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'letter_dt'); ?>
		<?php echo $form->textField($model,'letter_dt',array('size'=>15,'maxlength'=>75,'value'=>$now, 'readonly' => 1)); ?>
		<?php echo $form->error($model,'letter_dt'); ?>
	</div>

		<?php echo $form->hiddenField($model,'banns_id',array('value'=>$data->id)); ?>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

</div>

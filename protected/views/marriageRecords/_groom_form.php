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

	<div class="row">
	<span class="leftHalf">
		<?php echo $form->labelEx($model,'groom_name', array('style'=>'display:inline')); ?>
		<?php echo CHtml::link(CHtml::image(Yii::app()->request->baseUrl . '/images/search.png'),
			array('/person/findMatch', 'sex' => 'male'), array('id' => 'groom_search')); ?>
		<?php echo CHtml::link(CHtml::image(Yii::app()->request->baseUrl . '/images/clear.png'),
			array('#'), array('id' => 'groom_clear', 'title' => 'Clear groom fields')); ?><br />
		<?php echo $form->textField($model,'groom_name',array('size'=>35,'maxlength'=>100)); ?>
		<?php echo $form->hiddenField($model,'groom_id'); ?>
		<?php echo $form->error($model,'groom_name'); ?>
	</span>

	<span class="rightHalf">
		<?php echo $form->labelEx($model,'groom_baptism_dt'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'attribute' => "groom_baptism_dt",
			'options'	=> array(
				'dateFormat' => Yii::app()->params['dateFmtDP'],
				'yearRange'  => '1900:c+10',
				'changeYear' => true
			),
			'htmlOptions' => array(
				'size' => '10',         // textField size
				'maxlength' => '10',    // textField maxlength
			),
		)); ?>
		<?php echo $form->error($model,'groom_baptism_dt'); ?>
	</span>
	</div>

	<div class="row">
	<span class="leftHalf">
		<?php echo $form->labelEx($model,'groom_status'); ?>
		<?php echo $form->dropDownList($model,'groom_status',FieldNames::values('marital_status'), array('prompt' => '-- Select --')); ?>
		<?php echo $form->error($model,'groom_status'); ?>
	</span>

	<span class="rightHalf">
		<?php echo $form->labelEx($model,'groom_rank_prof'); ?>
		<?php echo $form->textField($model,'groom_rank_prof',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'groom_rank_prof'); ?>
	</span>
	</div>

	<div class="row">
	<span class="leftHalf">
		<?php echo $form->labelEx($model,'groom_fathers_name'); ?>
		<?php echo $form->textField($model,'groom_fathers_name',array('size'=>40,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'groom_fathers_name'); ?>
	</span>
	<span class="rightHalf">
		<?php echo $form->labelEx($model,'groom_mothers_name'); ?>
		<?php echo $form->textField($model,'groom_mothers_name',array('size'=>40,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'groom_mothers_name'); ?>
	</span>
	</div>

	<div class="row">
	<span class="leftHalf">
		<?php echo $form->labelEx($model,'groom_dob'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'attribute' => "groom_dob",
			'options'	=> array(
				'dateFormat' => Yii::app()->params['dateFmtDP'],
				'yearRange'  => '1900:c+10',
				'changeYear' => true
			),
			'htmlOptions' => array(
				'size' => '10',         // textField size
				'maxlength' => '10',    // textField maxlength
			),
		)); ?>
		<?php echo $form->error($model,'groom_dob'); ?>
	</span>

	<span class="rightHalf">
		<?php echo $form->labelEx($model,'groom_residence'); ?>
		<?php echo $form->textField($model,'groom_residence',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'groom_residence'); ?>
	</span>
	</div>



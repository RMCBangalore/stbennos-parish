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
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'banns-record-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'groom_parish'); ?>
		<?php if ('bride' != $local) {
			echo CHtml::textField('groom_parish_pub', Parish::get()->name, array('readonly' => true));
			echo $form->hiddenField($model,'groom_parish',array('value'=>$groom->id));
		} else {
			echo $form->textField($model,'groom_parish',array('size'=>50,'maxlength'=>50));
		} ?>
		<?php echo $form->error($model,'groom_parish'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'groom_name'); ?>
		<?php
			$parms = array('size'=>60,'maxlength'=>100);
			if ('bride' != $local) {
				$parms['value'] = $groom->fullname();
				$parms['readonly'] = true;
			}
			echo $form->textField($model,'groom_name',$parms); ?>
		<?php echo $form->error($model,'groom_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'groom_parent'); ?>
		<?php
			$parms = array('size'=>60,'maxlength'=>100);
			if ('bride' != $local) {
				$parms['value'] = $groom->getParent()->fullname();
				$parms['readonly'] = true;
			}
			echo $form->textField($model,'groom_parent',$parms); ?>
		<?php echo $form->error($model,'groom_parent'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'bride_parish'); ?>
		<?php if ('groom' != $local) {
			echo CHtml::textField('bride_parish_pub', Parish::get()->name, array('readonly' => true));
			echo $form->hiddenField($model,'bride_parish',array('value'=>$bride->id));
		} else {
			echo $form->textField($model,'bride_parish',array('size'=>50,'maxlength'=>50));
		} ?>
		<?php echo $form->error($model,'bride_parish'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'bride_name'); ?>
		<?php
			$parms = array('size'=>60,'maxlength'=>100);
			if ('groom' != $local) {
				$parms['value'] = $bride->fullname();
				$parms['readonly'] = true;
			}
			echo $form->textField($model,'bride_name',$parms); ?>
		<?php echo $form->error($model,'bride_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'bride_parent'); ?>
		<?php
			$parms = array('size'=>60,'maxlength'=>100);
			if ('groom' != $local) {
				$parms['value'] = $bride->getParent()->fullname();
				$parms['readonly'] = true;
			}
			echo $form->textField($model,'bride_parent',$parms); ?>
		<?php echo $form->error($model,'bride_parent'); ?>
	</div>

	<div class="row">
		<label>Banns Dates</label>
		1st
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'attribute' => 'banns_dt1',
			'options'	=> array(
				'dateFormat' => Yii::app()->params['dateFmtDP'],
				'yearRange'  => '1900:c+10',
			),
			'htmlOptions' => array(
				'size' => '10',         // textField size
				'maxlength' => '10',    // textField maxlength
			),
		)); ?>
		<?php echo $form->error($model,'banns_dt1'); ?>
		2nd
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'attribute' => 'banns_dt2',
			'options'	=> array(
				'dateFormat' => Yii::app()->params['dateFmtDP'],
				'yearRange'  => '1900:c+10',
			),
			'htmlOptions' => array(
				'size' => '10',         // textField size
				'maxlength' => '10',    // textField maxlength
			),
		)); ?>
		<?php echo $form->error($model,'banns_dt2'); ?>
		3rd
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'attribute' => 'banns_dt3',
			'options'	=> array(
				'dateFormat' => Yii::app()->params['dateFmtDP'],
				'yearRange'  => '1900:c+10',
			),
			'htmlOptions' => array(
				'size' => '10',         // textField size
				'maxlength' => '10',    // textField maxlength
			),
		)); ?>
		<?php echo $form->error($model,'banns_dt3'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

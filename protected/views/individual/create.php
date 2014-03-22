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
/* @var $this IndividualController */
/* @var $model Individuals */

$this->breadcrumbs=array(
	'Individuals'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Individuals', 'url'=>array('index')),
	array('label'=>'Manage Individuals', 'url'=>array('admin')),
);
?>

<style>
div.msg {
	float: right;
}
</style>

<h1>Create Individual</h1>
<?php 
if (1 == $step) {
	echo '<div class="msg">Not what you want? ';
	echo '<a href="' . Yii::app()->createUrl('/family/create', array('id' => $model->id)) . '">Create a family instead</a>';
	echo '</div>';
}
echo "<p>Step $step of 2"; ?></p>
<div class="form">

<?php $parms = array('step' => $step);
if (isset($model->id)) {
	$parms['id'] = $model->id;
}
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'individuals-form',
	'enableAjaxValidation'=>true,
	'action'=>Yii::app()->createUrl('/individual/create', $parms)
));
$member = $model->member;
if (!isset($member)) {
	$member = new People();
}
$unit = $model->isNewRecord ? new Units() : $model->unit;
$tabs = array(
	0=>array(
		'title'=>'Unit Data',
		'view'=>'_form_fields',
		'data'=>array(
			'form'=>$form,
			'model'=>$model,
			'unit'=>$unit,
		),
	),
	1=>array(
		'title'=>'Member',
		'view'=>'../person/_person_form',
		'data'=>array(
			'form'=>$form,
			'person'=>'member',
			'model'=>$member,
			'ac'=>$ppl_ac
		),
	),
);
$sel_tabs = array_slice($tabs, 0, $step);
if ($cur_model->errors) {
	$sel_tabs[$step - 1]['data']['model'] = $cur_model;
}
?>

<?php echo isset($model->id) ? $form->hiddenField($model,'id',array('value'=>$model->id)) : ''; ?>

<p class="note">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($cur_model); ?>
<?php $this->widget('CTabView',array(
	'tabs'=>$sel_tabs,
	'activeTab'=>$step-1,
)); ?>
<div class="row buttons">
	<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<script type="text/javascript">
$('#Individuals_marriage_date').change(function(e) {
	$('#People_husband_marriage_dt').val(this.value);
	$('#People_wife_marriage_dt').val(this.value);
} );
</script>

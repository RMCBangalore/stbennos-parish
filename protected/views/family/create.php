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
/* @var $this FamilyController */
/* @var $model Families */

$this->breadcrumbs=array(
	'Families'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Families', 'url'=>array('index')),
	array('label'=>'Manage Families', 'url'=>array('admin')),
);
?>

<h1>Create Family</h1>
<?php
echo "<p>Step $step of 8";
if (isset($model->id)) {
	if ($step != 3 or isset($model->husband)) {
		echo ' | <a href="' . Yii::app()->createUrl('/family/create', array('id' => $model->id, 'step' => $step+1)) . '">Skip</a>';
	}
} ?></p>
<div class="form">

<?php $parms = array('step' => $step);
if (isset($model->id)) {
	$parms['id'] = $model->id;
}
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'families-form',
	'enableAjaxValidation'=>true,
	'action'=>Yii::app()->createUrl('/family/create', $parms)
));
$husband = $model->husband;
if (!isset($husband)) {
	$husband = new People();
	$husband->sex = 1;
	$husband->marriage_dt = $model->marriage_date;
}
$wife = $model->wife;
if (!isset($wife)) {
	$wife = new People();
	$wife->sex = 2;
	$wife->marriage_dt = $model->marriage_date;
}
$dependents = $model->dependents();
$tabs = array(
	0=>array(
		'title'=>'Family Data',
		'view'=>'_form_fields',
		'data'=>array(
			'form'=>$form,
			'model'=>$model,
			'ac'=>$fam_ac,
		),
	),
	1=>array(
		'title'=>'Husband',
		'view'=>'../person/_person_form',
		'data'=>array(
			'form'=>$form,
			'person'=>'husband',
			'model'=>$husband,
			'ac'=>$ppl_ac
		),
	),
	2=>array(
		'title'=>'Wife',
		'view'=>'../person/_person_form',
		'data'=>array(
			'form'=>$form,
			'person'=>'wife',
			'model'=>$wife,
			'ac'=>$ppl_ac
		),
	),
	3=>array(
		'title'=>'Dependent 1',
		'view'=>'../person/_person_form',
		'data'=>array(
			'form'=>$form,
			'person'=>'dependent][0',
			'model'=>(isset($dependents[0])?$dependents[0]:new People()),
			'ac'=>$ppl_ac
		),
	),
	4=>array(
		'title'=>'Dependent 2',
		'view'=>'../person/_person_form',
		'data'=>array(
			'form'=>$form,
			'person'=>'dependent][1',
			'model'=>(isset($dependents[1])?$dependents[1]:new People()),
			'ac'=>$ppl_ac
		),
	),
);
$children = $model->children();
for($i = 0; $i < 3; ++$i) {
	$n = 5 + $i;
	$j = 1 + $i;
	$child = isset($children[$i]) ? $children[$i] : new People();
	$tabs[$n] = array(
		'title' => "Child $j",
		'view'	=> '../person/_person_form',
		'data'	=> array(
			'form'		=> $form,
			'person'	=> "child][$i",
			'model'		=> $child,
			'ac'=>$ppl_ac
		)
	);
}
$sel_tabs = array_slice($tabs, 0, $step);
if ($cur_model->errors) {
	$sel_tabs[$step - 1]['data']['model'] = $cur_model;
}
 ?>

	<?php echo isset($model->id) ? $form->hiddenField($model,'id',array('value'=>$model->id)) : ''; ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($cur_model); ?>
<?php
?>
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
$('#Families_marriage_date').change(function(e) {
	$('#People_husband_marriage_dt').val(this.value);
	$('#People_wife_marriage_dt').val(this.value);
} );
</script>

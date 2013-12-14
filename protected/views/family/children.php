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
/* @var $this FamilyController */
/* @var $model Families */

$this->breadcrumbs=array(
	'Families'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Families', 'url'=>array('index')),
	array('label'=>'Create Family', 'url'=>array('create')),
	array('label'=>'View Families', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Families', 'url'=>array('admin')),
);
?>

<h1>Family <?php echo $model->id; ?>: More Children</h1>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'families-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
<?php
	$tabs = array(
	);
	$children = $model->children();
	for($i = 0; $i < 10; ++$i) {
		$n = 2 + $i;
		$j = 4 + $i;
		$child = isset($children[$j-1]) ? $children[$j-1] : new People();
		$tabs["tab$n"] = array(
			'title' => "Child $j",
			'view'	=> '../person/_person_form',
			'data'	=> array(
				'form'		=> $form,
				'person'	=> "child][$i",
				'model'		=> $child,
				'ac'		=> $ppl_ac,
			)
		);
	}
?>
    <?php $this->widget('CTabView',array(
    'tabs'=>$tabs
	)); ?>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

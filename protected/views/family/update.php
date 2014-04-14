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
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Families', 'url'=>array('index')),
	array('label'=>'Create Family', 'url'=>array('create')),
	array('label'=>'View Family', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Families', 'url'=>array('admin')),
);
?>

<h1>Update Family <?php echo $model->id; ?></h1>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'families-form',
	'enableAjaxValidation'=>true,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
<?php
	$husband = $model->husband;
	if (!isset($husband)) {
		$husband = new People();
	}
	$wife = $model->wife;
	if (!isset($wife)) {
		$wife = new People();
	}
	$children = $model->children();
	$dependents = $model->dependents();
	$tabs = array(
        'tab1'=>array(
            'title'=>'Family Data',
            'view'=>'_form_fields',
            'data'=>array(
				'form'=>$form,
				'ac'=>$fam_ac,
                'model'=>$model,
            ),
        ),
        'tab2'=>array(
            'title'=>'Husband',
            'view'=>'../person/_person_form',
            'data'=>array(
				'form'=>$form,
				'person'=>'husband',
                'model'=>$husband,
				'ac'=>$ppl_ac
            ),
        ),
        'tab3'=>array(
            'title'=>'Wife',
            'view'=>'../person/_person_form',
            'data'=>array(
				'form'=>$form,
				'person'=>'wife',
                'model'=>$wife,
				'ac'=>$ppl_ac
            ),
        ),
        'tab4'=>array(
            'title'=>'Dependent 1',
            'view'=>'../person/_person_form',
            'data'=>array(
				'form'=>$form,
				'person'=>'dependent][0',
                'model'=>(isset($dependents[0])?$dependents[0]:new People()),
				'ac'=>$ppl_ac
			),
		),
        'tab5'=>array(
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
	for($i = 0; $i < 3; ++$i) {
		$n = 6 + $i;
		$j = 1 + $i;
		$child = isset($children[$i]) ? $children[$i] : new People();
		$tabs["tab$n"] = array(
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
?>
    <?php $this->widget('CTabView',array(
    'tabs'=>$tabs
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

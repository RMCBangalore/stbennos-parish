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
/* @var $this MarriageRecordsController */
/* @var $model MarriageRecord */

$this->breadcrumbs=array(
       'Registers' => array('site/page', 'view' => 'registers'),
	'Marriage Records'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List MarriageRecord', 'url'=>array('index')),
	array('label'=>'Create MarriageRecord', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('#submit-button').click(function(){
	$('#marriage-record-grid').yiiGridView('update', {
		data: $('.search-form').serialize()
	});
	return false;
});
");
?>

<h1>Manage Marriage Records</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'marriage-record-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'ajaxUpdate'=>false,
	'columns'=>array(
		'id',
		'marriage_dt',
		'groom_name',
		'groom_dob',
		/*
		'groom_rank_prof',
		'groom_fathers_name',
		'groom_mothers_name',
		'groom_residence',
		*/
		'bride_name',
		'bride_dob',
		/*
		'bride_status',
		'bride_rank_prof',
		'bride_fathers_name',
		'bride_mothers_name',
		'bride_residence',
		'banns_licence',
		'minister',
		'witness1',
		'witness2',
		'remarks',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>

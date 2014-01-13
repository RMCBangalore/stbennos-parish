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
	'Survey',
);

$this->menu=array(
	array('label'=>'List Families', 'url'=>array('index')),
	array('label'=>'Create Family', 'url'=>array('create')),
	array('label'=>'View Family', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Families', 'url'=>array('admin')),
);
?>

<h1>Survey Family <?php echo $model->id; ?></h1>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'families-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
<?php
	$tabs = array(
        'tab1'=>array(
            'title'=>'Satisfaction',
            'view'=>'../satisfactionItems/ask',
            'data'=>array(
				'form'=>$form,
                'model'=>$model,
				'satisfactionItems' => $satisfactionItems,
				'satisfactionData' => $satisfactionData,
            ),
        ),
        'tab2'=>array(
            'title'=>'Needs',
            'view'=>'../needItems/ask',
            'data'=>array(
				'form'=>$form,
                'model'=>$model,
				'needItems' => $needItems,
				'needData' => $needData,
            ),
        ),
        'tab3'=>array(
            'title'=>'Awareness',
            'view'=>'../awarenessItems/ask',
            'data'=>array(
				'form'=>$form,
                'model'=>$model,
				'awarenessItems' => $awarenessItems,
				'awarenessData' => $awarenessData,
            ),
        ),
        'tab4'=>array(
            'title'=>'Open Questions',
            'view'=>'../openQuestions/ask',
            'data'=>array(
				'form'=>$form,
                'model'=>$model,
				'openQuestions' => $openQuestions,
				'openData' => $model->openData,
            ),
        ),
	);
?>
    <?php $this->widget('CTabView',array(
    'tabs'=>$tabs
	)); ?>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->


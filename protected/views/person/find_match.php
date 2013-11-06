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
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id' => 'findMatchForm',
	'method' => 'GET',
)); 

	echo CHtml::label('', 'key');
	echo CHtml::textField('key', '', array('id' => 'key'));
	echo CHtml::link(CHtml::imageButton(Yii::app()->request->baseUrl . '/images/search.png'), '#',
		array('id' => 'find_match'));

$this->endWidget();

	$this->widget('zii.widgets.grid.CGridView', array(
		'dataProvider' => $members,
            'columns' => array(           
                array(                              
                    'class' => 'CCheckBoxColumn',
                    'selectableRows' => 1,
                    'checkBoxHtmlOptions' => array(
                        'name' => 'person'
                    )
                ),
				'mid',
				'fname',
				'lname',
				/*
                array(
					'value' => '$data->fullname()',
					'name' => 'Name'
				),
				*/
                'dob',
				'baptism_dt',
				'profession',
                array(
                    'value' => '$data->family->husband_id ? $data->family->husband->fullname() : ""',
                    'name' => 'Fathers Name'                                                       
                ),
                array(
                    'value' => '$data->family->wife_id ? $data->family->wife->fullname() : ""',
                    'name' => 'Mothers Name'                                                       
                )
            ),
        ));
?>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Select', array('id' => 'submitMatch')); ?>
    </div>                 

</div>

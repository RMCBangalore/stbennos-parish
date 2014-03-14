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
		'dataProvider' => $families,
            'columns' => array(           
                array(                              
                    'class' => 'CCheckBoxColumn',
                    'selectableRows' => 1,
                    'checkBoxHtmlOptions' => array(
                        'name' => 'family'
                    )
                ),
				'id',
				'fid',
				array(
					'header' => 'Husband Name',
					'value' => 'isset($data->husband_id) ? $data->husband->fullname() : ""'
				),
				array(
					'header' => 'Wife Name',
					'value' => 'isset($data->wife_id) ? $data->wife->fullname() : ""'
				),
                'marriage_date',
				array(
					'header' => 'Address',
					'value' => 'implode(", ", array($data->addr_nm, $data->addr_stt, ' .
						'$data->addr_area)) . " - " . $data->addr_pin'
				),
            ),
        ));
?>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Select', array('id' => 'submitMatch')); ?>
    </div>                 

</div>

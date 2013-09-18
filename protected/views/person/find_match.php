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

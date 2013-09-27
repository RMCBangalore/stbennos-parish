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

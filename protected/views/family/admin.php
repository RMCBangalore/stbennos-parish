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
	'Manage',
);

$this->menu=array(
	array('label'=>'List Families', 'url'=>array('index')),
	array('label'=>'Create Families', 'url'=>array('create')),
);

$this->widget('application.extensions.fancybox.EFancyBox', array(
    'target'=>'a[rel=gallery]',
	'config'=>array(),
));

Yii::app()->clientScript->registerScript('search', "
function set_datepicker(url) {
	jQuery('#Families_leaving_date').datepicker( {
		'dateFormat':'dd/mm/yy',
		'yearRange':'1900:c+10',
		'changeYear':true,
		'onSelect': function(ds, inst) {
			$.post(url, { 'leaving_date': ds });
			$.fancybox.close();
		}
	} );
}
$('td.button-column a.delete').fancybox( {
	'onComplete': function() {
		set_datepicker($(this).attr('href'));
	}
} );
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('#submit-button').click(function(){
	$('#families-grid').yiiGridView('update', {
		data: $('.search-form form').serialize()
	});
	return false;
});
$(document).ready(function() {
	$('#sub_till_mth').focus(function () {
        $('.ui-datepicker-calendar').hide();
        $('#ui-datepicker-div').position({
            my: 'center top',
            at: 'center bottom',
            of: $(this)
        });
    });
	$('#sub_till_mth').datepicker( {
		changeMonth: true,
		changeYear: true,
		showButtonPanel: true,
		dateFormat: 'M yy',
		onClose: function(dateText, inst) { 
			var month = $('#ui-datepicker-div .ui-datepicker-month :selected').val();
			var year = $('#ui-datepicker-div .ui-datepicker-year :selected').val();
			$(this).datepicker('setDate', new Date(year, month, 1));
			var pref = '';
			if (1 == $('#sub_paid').val()) {
				pref = '!';
			}
			$('#Families_sub_till').val(pref + year + '-' + (parseInt(month)+1));
		}
	});
	$('#sub_paid').change(function() {
		if (1 == this.value) {
			$('#Families_sub_till').val('!' + $('#Families_sub_till').val());
		} else {
			$('#Families_sub_till').val($('#Families_sub_till').val().replace(/^!/,''));
		}
	} );
});
");
?>

<h1>Manage Families</h1>

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
	'id'=>'families-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'fid',
		'head_name',
		array(
			'header' => 'Address',
			'value' => 'implode(", ", array(' .
				'$data->addr_nm, $data->addr_stt, $data->addr_area))." - ".$data->addr_pin',
		),
		'sub_till',
		/*
		'phone',
		'mobile',
		'email',
		'zone',
		'yr_reg',
		'bpl_card',
		'marriage_church',
		'marriage_date',
		'marriage_type',
		'marriage_status',
		'monthly_income',
		*/
		array(
			'class'=>'CButtonColumn',
			'deleteButtonLabel' => 'Disable',
			'deleteButtonUrl' => 'array(($data->disabled ? "enable" : "disable"), "id" => $data->id)',
			'deleteConfirmation' => 'Are you sure you want to disable this family?',
		),
	),
)); ?>

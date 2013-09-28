<?php
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

Yii::app()->clientScript->registerScript('search', "
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
	$('#sub_till_mth').click(function() {
		$('.ui-datepicker-calendar').addClass('monthpicker');
	} );
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
		dateFormat: 'MM yy',
		onChangeMonthYear: function(yr,mth,inst) {
			$('.ui-datepicker-calendar').addClass('monthpicker');
		},
		onClose: function(dateText, inst) { 
			var month = $('#ui-datepicker-div .ui-datepicker-month :selected').val();
			var year = $('#ui-datepicker-div .ui-datepicker-year :selected').val();
			$('.ui-datepicker-calendar').removeClass('monthpicker');
			$(this).datepicker('setDate', new Date(year, month, 1));
			$('#Families_sub_till').val(year + '-' + (parseInt(month)+1));
		}
	});
});
");
?>

<style>
.monthpicker {
    display: none;
}
</style>

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
		),
	),
)); ?>

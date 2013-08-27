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
		'addr_nm',
		'addr_stt',
		'addr_area',
		'addr_pin',
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

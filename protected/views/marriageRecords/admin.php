<?php
/* @var $this MarriageRecordsController */
/* @var $model MarriageRecord */

$this->breadcrumbs=array(
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
$('.search-form form').submit(function(){
	$('#marriage-record-grid').yiiGridView('update', {
		data: $(this).serialize()
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
	'columns'=>array(
		'id',
		'marriage_dt',
		'groom_name',
		'groom_dob',
		'groom_status',
		'groom_rank_prof',
		/*
		'groom_fathers_name',
		'groom_mothers_name',
		'groom_residence',
		'bride_name',
		'bride_dob',
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

<?php
/* @var $this PersonController */
/* @var $model People */

$this->breadcrumbs=array(
	'Peoples'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List People', 'url'=>array('index')),
	array('label'=>'Create People', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('#submit-button').click(function(){
	$('#people-grid').yiiGridView('update', {
		data: $('.search-form form').serialize()
	});
	return false;
});
");
?>

<h1>Manage People</h1>

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
	'id'=>'people-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'ajaxUpdate'=>false,
	'columns'=>array(
		'id',
		'fname',
		'lname',
		'sex',
		'domicile_status',
		'dob',
		/*
		'education',
		'profession',
		'occupation',
		'mobile',
		'email',
		'lang_pri',
		'lang_lit',
		'lang_edu',
		'rite',
		'baptism_dt',
		'baptism_church',
		'baptism_place',
		'god_parents',
		'first_comm_dt',
		'confirmation_dt',
		'marriage_dt',
		'cemetery_church',
		'family_id',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>

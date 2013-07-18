<?php
/* @var $this FieldValueController */
/* @var $model FieldValues */

$this->breadcrumbs=array(
	'Field Values'=>array('index'),
	'Manage',
);

$lbl = $_GET['type'] ? ucwords(implode(' ', explode('_', $_GET['type']))) : 'Field Values';

$this->menu=array(
	array('label'=>"List $lbl", 'url'=>array('index', 'type' => $_GET['type'])),
	array('label'=>"Create $lbl", 'url'=>array('create', 'type' => $_GET['type'])),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#field-values-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage <?php echo $lbl ?></h1>

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
	'id'=>'field-values-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'name',
		'code',
		'pos',
		array(
			'class'=>'CButtonColumn',
			'viewButtonUrl'=>'Yii::app()->createUrl("/fieldValue/view", array("id" => $data->id, "type" => $_GET["type"]))',
			'updateButtonUrl'=>'Yii::app()->createUrl("/fieldValue/update", array("id" => $data->id, "type" => $_GET["type"]))',
			'deleteButtonUrl'=>'Yii::app()->createUrl("/fieldValue/delete", array("id" => $data->id, "type" => $_GET["type"]))'
		),
	),
)); ?>

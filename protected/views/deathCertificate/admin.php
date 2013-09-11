<?php
/* @var $this DeathCertificateController */
/* @var $model DeathCertificate */

$this->breadcrumbs=array(
       'Certificates' => array('site/page', 'view' => 'certificates'),
	'Death Certificates'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List DeathCertificate', 'url'=>array('index')),
	array('label'=>'Create DeathCertificate', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#death-certificate-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Death Certificates</h1>

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
	'id'=>'death-certificate-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'death_id',
		'cert_dt',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>

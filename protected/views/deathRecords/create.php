<?php
/* @var $this DeathRecordsController */
/* @var $model DeathRecord */

$this->breadcrumbs=array(
       'Registers' => array('site/page', 'view' => 'registers'),
	'Death Records'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List DeathRecord', 'url'=>array('index')),
	array('label'=>'Manage DeathRecord', 'url'=>array('admin')),
);
?>

<h1>Create DeathRecord</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
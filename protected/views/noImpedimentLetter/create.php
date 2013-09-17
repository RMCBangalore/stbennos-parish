<?php
/* @var $this NoImpedimentLetterController */
/* @var $model NoImpedimentLetter */

$this->breadcrumbs=array(
       'Certificates' => array('site/page', 'view' => 'certificates'),
	'No Impediment Letters'=>array('index'),
	'Create',
);

$this->menu=array(
 	array('label'=>'Create BannsRecord', 'url'=>array('/bannsRecords/create')),
	array('label'=>'List NoImpedimentLetter', 'url'=>array('index')),
	array('label'=>'Manage NoImpedimentLetter', 'url'=>array('admin')),
);
?>

<h1>Create NoImpedimentLetter</h1>

<?php echo $this->renderPartial('_form_full', array(
	'model'=>$model,
	'data' => $banns,
	'now' => $now,
)); ?>


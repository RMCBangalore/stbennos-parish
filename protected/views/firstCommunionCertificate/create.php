<?php
/* @var $this FirstCommunionCertificateController */
/* @var $model FirstCommunionCertificate */

$this->breadcrumbs=array(
       'Certificates' => array('site/page', 'view' => 'certificates'),
	'First Communion Certificates'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List First Communion Certificate', 'url'=>array('index')),
	array('label'=>'Manage First Communion Certificate', 'url'=>array('admin')),
);
?>

<h1>Create First Communion Certificate</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'firstCommunion' => $firstCommunion, 'now' => $now)); ?>

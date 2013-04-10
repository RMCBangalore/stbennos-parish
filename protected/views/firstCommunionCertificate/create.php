<?php
/* @var $this FirstCommunionCertificateController */
/* @var $model FirstCommunionCertificate */

$this->breadcrumbs=array(
	'First Communion Certificates'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List FirstCommunionCertificate', 'url'=>array('index')),
	array('label'=>'Manage FirstCommunionCertificate', 'url'=>array('admin')),
);
?>

<h1>Create FirstCommunionCertificate</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
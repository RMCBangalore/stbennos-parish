<?php
/* @var $this MarriageCertificateController */
/* @var $model MarriageCertificate */

$this->breadcrumbs=array(
	'Marriage Certificates'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List MarriageCertificate', 'url'=>array('index')),
	array('label'=>'Manage MarriageCertificate', 'url'=>array('admin')),
);
?>

<h1>Create MarriageCertificate</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
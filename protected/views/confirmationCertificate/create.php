<?php
/* @var $this ConfirmationCertificatesController */
/* @var $model ConfirmationCertificate */

$this->breadcrumbs=array(
       'Certificates' => array('site/page', 'view' => 'certificates'),
	'Confirmation Certificates'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ConfirmationCertificate', 'url'=>array('index')),
	array('label'=>'Manage ConfirmationCertificate', 'url'=>array('admin')),
);
?>

<h1>Create ConfirmationCertificate</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'confirmation' => $confirmation)); ?>

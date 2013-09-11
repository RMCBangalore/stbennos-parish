<?php
/* @var $this DeathCertificateController */
/* @var $model DeathCertificate */

$this->breadcrumbs=array(
       'Certificates' => array('site/page', 'view' => 'certificates'),
	'Death Certificates'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List DeathCertificate', 'url'=>array('index')),
	array('label'=>'Manage DeathCertificate', 'url'=>array('admin')),
);
?>

<h1>Create DeathCertificate</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,
	'death' => $death)); ?>

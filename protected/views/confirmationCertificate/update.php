<?php
/* @var $this ConfirmationCertificatesController */
/* @var $model ConfirmationCertificate */

$this->breadcrumbs=array(
       'Certificates' => array('site/page', 'view' => 'certificates'),
	'Confirmation Certificates'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
 	array('label'=>'Create ConfirmationRecord', 'url'=>array('/confirmationRecords/create')),
	array('label'=>'List ConfirmationCertificate', 'url'=>array('index')),
	array('label'=>'View ConfirmationCertificate', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ConfirmationCertificate', 'url'=>array('admin')),
);
?>

<h1>Update ConfirmationCertificate <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
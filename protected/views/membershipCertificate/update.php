<?php
/* @var $this MembershipCertificateController */
/* @var $model MembershipCertificate */

$this->breadcrumbs=array(
	'Membership Certificates'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List MembershipCertificate', 'url'=>array('index')),
	array('label'=>'Create MembershipCertificate', 'url'=>array('create')),
	array('label'=>'View MembershipCertificate', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage MembershipCertificate', 'url'=>array('admin')),
);
?>

<h1>Update MembershipCertificate <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
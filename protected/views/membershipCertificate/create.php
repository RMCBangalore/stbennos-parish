<?php
/* @var $this MembershipCertificateController */
/* @var $model MembershipCertificate */

$this->breadcrumbs=array(
	'Membership Certificates'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List MembershipCertificate', 'url'=>array('index')),
	array('label'=>'Manage MembershipCertificate', 'url'=>array('admin')),
);
?>

<h1>Create MembershipCertificate</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'member' => $member)); ?>

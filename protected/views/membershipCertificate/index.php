<?php
/* @var $this MembershipCertificateController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Membership Certificates',
);

$this->menu=array(
	array('label'=>'Create MembershipCertificate', 'url'=>array('create')),
	array('label'=>'Manage MembershipCertificate', 'url'=>array('admin')),
);
?>

<h1>Membership Certificates</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

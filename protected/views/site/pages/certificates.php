<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name . ' - About';
$this->breadcrumbs=array(
	'Certificates',
);

$this->menu=array(
	array('label' => 'Create Family', 'url' => array('family/create')),
	array('label' => 'Manage Families', 'url' => array('family/admin'))
);
?>
<h1>Certificates</h1>

<p>
	<?php echo CHtml::link('Marriage Certificates', array('marriageCertificate/index')); ?>
</p><p>
	<?php echo CHtml::link('Baptism Certificates', array('baptismCertificate/index')); ?>
</p><p>
	<?php echo CHtml::link('First Communion Certificates', array('firstCommunionCertificate/index')); ?>
</p><p>
	<?php echo CHtml::link('Confirmation Certificates', array('confirmationCertificate/index')); ?>
</p><p>
	<?php echo CHtml::link('Death Certificates', array('deathCertificate/index')); ?>
</p><p>
	<?php echo CHtml::link('Banns Request Letters', array('bannsRequest/index')); ?>
</p><p>
	<?php echo CHtml::link('Banns Response Letters', array('bannsResponse/index')); ?>
</p><p>
	<?php echo CHtml::link('No Impediment Letters', array('noImpedimentLetter/index')); ?>
</p>

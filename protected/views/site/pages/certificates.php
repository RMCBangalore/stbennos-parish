<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name . ' - About';
$this->breadcrumbs=array(
	'Certificates',
);

?>
<h1>Certificates</h1>

	<?php echo CHtml::link(
				CHtml::image(Yii::app()->baseUrl . '/images/icons/marriage certificates.png', 'Marriage Certificates'),
				array('marriageCertificate/index')); ?>
	<?php echo CHtml::link(
				CHtml::image(Yii::app()->baseUrl . '/images/icons/baptism certificates.png', 'Baptism Certificates'),
				array('baptismCertificate/index')); ?>
	<?php echo CHtml::link(
				CHtml::image(Yii::app()->baseUrl . '/images/icons/1stholycommunion certificates.png', 'First Communion Certificates'),
				array('firstCommunionCertificate/index')); ?>
	<?php echo CHtml::link(
				CHtml::image(Yii::app()->baseUrl . '/images/icons/confirmation certificates.png', 'Confirmation Certificates'),
				array('confirmationCertificate/index')); ?>
	<?php echo CHtml::link(
				CHtml::image(Yii::app()->baseUrl . '/images/icons/death&burial certificates.png', 'Death Certificates'),
				array('deathCertificate/index')); ?>
	<?php echo CHtml::link(
				CHtml::image(Yii::app()->baseUrl . '/images/icons/banns request.png', 'Banns Request Letters'),
				array('bannsRequest/index')); ?>
	<?php echo CHtml::link(
				CHtml::image(Yii::app()->baseUrl . '/images/icons/banns response.png', 'Banns Response Letters'),
				array('bannsResponse/index')); ?>
	<?php echo CHtml::link(
				CHtml::image(Yii::app()->baseUrl . '/images/icons/no impediment.png', 'No Impediment Letters'),
				array('noImpedimentLetter/index')); ?>

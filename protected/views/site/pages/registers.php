<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name . ' - About';
$this->breadcrumbs=array(
	'Registers',
);

?>
<h1>Registers</h1>

<?php
	echo CHtml::link(
			CHtml::image(Yii::app()->baseUrl . '/images/icons/baptism register.png', 'Baptism Register'),
			array('baptismRecords/index'));
	echo CHtml::link(
			CHtml::image(Yii::app()->baseUrl . '/images/icons/1stholycommunion register.png', 'First Communion Register'),
			array('firstCommunionRecords/index'));
	echo CHtml::link(
			CHtml::image(Yii::app()->baseUrl . '/images/icons/confirmation register.png', 'Confirmation Register'),
			array('confirmationRecords/index'));
	echo CHtml::link(
			CHtml::image(Yii::app()->baseUrl . '/images/icons/marriage register.png', 'Marriage Register'),
			array('marriageRecords/index'));
	echo CHtml::link(
			CHtml::image(Yii::app()->baseUrl . '/images/icons/banns register.png', 'Banns Register'),
			array('bannsRecords/index'));
	echo CHtml::link(
			CHtml::image(Yii::app()->baseUrl . '/images/icons/death&burialregister.png', 'Death Register'),
			array('deathRecords/index'));
 ?>

<?php
#
# This file is part of St. Benno's Parish Software
#
# St. Benno's Parish Software - software to manage tomorrow's parish
# Copyright (C) 2013  Redemptorist Media Center
#
# St. Benno's Parish Software is free software: you can redistribute it
# and/or modify it under the terms of the GNU General Public License as
# published by the Free Software Foundation, either version 3 of the
# License, or (at your option) any later version.
#
# St. Benno's Parish Software is distributed in the hope that it will
# be useful, but WITHOUT ANY WARRANTY; without even the implied warranty
# of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
#
# You should have received a copy of the GNU General Public License
# along with this program.  If not, see <http://www.gnu.org/licenses/>.
#
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name . ' - About';
$this->breadcrumbs=array(
	'Certificates',
);

?>
<h1>Certificates</h1>

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
				CHtml::image(Yii::app()->baseUrl . '/images/icons/marriage certificates.png', 'Marriage Certificates'),
				array('marriageCertificate/index')); ?>
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

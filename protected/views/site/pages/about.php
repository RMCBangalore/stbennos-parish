<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name . ' - About';
$this->breadcrumbs=array(
	'About',
);

$this->menu=array(
	array('label' => 'Create Family', 'url' => array('family/create')),
	array('label' => 'Manage Families', 'url' => array('family/admin'))
);
?>
<h1>About</h1>

<p>This software helps manage your parish, managing the data of parish families
and members to provide necessary information for essential functioning.</p>

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

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
	<meta name="google-translate-customization" content="9f0a39c0ffb3999c-c69ffe8bb987a246-g8a007ae370513f5f-c"></meta>
	<link href="<?php echo Yii::app()->request->baseUrl; ?>/favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

	<div id="header">
		<div id="logo"><?php $parish = Parish::get();
			if (isset($parish) and isset($parish->logo_src)) {
				echo CHtml::link(CHtml::image(Yii::app()->request->baseUrl . $parish->logo_src,
					CHtml::encode(Yii::app()->name),
						array('width' => $parish->logo_width, 'height' => $parish->logo_height)),
					 Yii::app()->request->baseUrl . '/');
		   } else {
				echo CHtml::link(CHtml::image(Yii::app()->request->baseUrl . '/images/logo-new.png',
					CHtml::encode(Yii::app()->name),
						array('width' => 405, 'height' => 100)), Yii::app()->request->baseUrl . '/');
		   } ?></div>
		<?php if (!Yii::app()->user->isGuest): ?>
		<div id="search">
			<?php $form=$this->beginWidget('CActiveForm', array(
						'id' => 'search_form',
						'action' => Yii::app()->createUrl('/site/search'),
						'method' => 'GET',
			));
			echo CHtml::textField('key', '', array('id' => 'search_key'));
			echo CHtml::imageButton(Yii::app()->request->baseUrl . '/images/search.png');
			$this->endWidget(); 
			Yii::app()->clientScript->registerScript('global-search', "
			kp = new Object;
			$('#search_key').keyup(function(e) {
				delete kp[e.which];
			} );
			$('#search_key').keydown(function(e) {
				kp[e.which] = true;
				if (kp[17] && (e.which == 74 || e.which == 72)) {
					window.location.href = '" . Yii::app()->createUrl('/family/search') . "?id=' + $('#search_key').val();
					return false;
				}
				return true;
			} );
			$('#search_form').submit(function() {
				$.get('/site/search', {
					'key': $('#search_key').val()
				}, function(data) {
					$('#content').html(data);
				} );
				return false;
			} );
			$('#search_key').focus();
			"); ?>
		</div>
		<?php endif ?>
	</div><!-- header -->

	<div id="google_translate_element"></div><script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en', includedLanguages: 'hi,kn,ta', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
}
</script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

	<div id="mainmenu">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Home', 'url'=>array('/site/index')),
				array('label'=>'Admin', 'url'=>array('/site/page', 'view' => 'admin'), 'visible' => Yii::app()->user->checkAccess('Pastor')),
				array('label'=>'Reports', 'url'=>array('/reports'), 'visible' => Yii::app()->user->checkAccess('Pastor')),
				array('label'=>'Help', 'url'=>array('/site/page', 'view'=>'help')),
				array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
			),
		)); ?>
	</div><!-- mainmenu -->
	<?php if(isset($this->breadcrumbs)):?>
		<?php if(preg_match('/^rights\//', Yii::app()->request->pathInfo)) {
			array_shift($this->breadcrumbs);
			$this->breadcrumbs = array('Admin' => array('/site/page', 'view' => 'admin')) + $this->breadcrumbs;
		} ?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		<a href="http://www.stbennos.com">St.Bennos Parish</a> <?php $vfile = dirname(__FILE__) . '/../../../VERSION.txt';
			if (file_exists($vfile)) {
				$ver_full = file_get_contents($vfile);
				$ver = preg_replace('/-g.*$/', '', $ver_full);
				echo "<acronym title='$ver_full'>$ver</acronym>";
			} ?>&nbsp;| Copyright &copy;<?php echo date('Y'); ?>, <a href="http://www.rmcbangalore.com">Redemptorist Media Center</a>.<br/>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>

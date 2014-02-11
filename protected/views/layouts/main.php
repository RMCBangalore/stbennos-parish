<?php
#
# This file is part of Alive Parish Software
#
# Alive Parish - software to manage tomorrow's parish
# Copyright (C) 2013  Redemptorist Media Center
#
# Alive Parish Software is free software: you can redistribute it
# and/or modify it under the terms of the GNU General Public License as
# published by the Free Software Foundation, either version 3 of the
# License, or (at your option) any later version.
#
# Alive Parish Software is distributed in the hope that it will
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
				echo CHtml::link(CHtml::image(Yii::app()->request->baseUrl . '/images/logo-new.gif',
					CHtml::encode(Yii::app()->name),
						array('width' => 200, 'height' => 100)), Yii::app()->request->baseUrl . '/');
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
				$.get($(this).attr('action'), {
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

	<div id="google_translate_element"></div>

	<div id="mainMbMenu">
		<?php
			$this->widget('application.extensions.mbmenu.MbMenu', array(
			'items'=>array(
				array('label'=>'Home', 'url'=>array('/site/index'),'items'=>array(
					array('label'=>'Parish Prolile','url'=>array('/site/parishProfile'),'visible'=>Yii::app()->user->checkAccess('Pastor')),
					array('label'=>'Families','visible'=>!Yii::app()->user->isGuest,'items'=>array(
						array('label'=>'View Families','url'=>array('/family/index')), 
						array('label'=>'Manage','url'=>array('/family/admin'),'visible'=>Yii::app()->user->checkAccess('Family.Admin')), 
						array('label'=>'Members','url'=>array('/person/index')), 
						array('label'=>'Subscriptions','url'=>array('family/subscriptions')),
					)),
					array('label'=>'Mass Booking','visible'=>Yii::app()->user->checkAccess('MassBooking.Index'),'url'=>array('massBooking/index')),
					array('label'=>'Registers','visible'=>!Yii::app()->user->isGuest,'url'=>array('/site/page','view'=>'registers'),'items'=>array(
						array('label'=>'Baptism','url'=>array('/baptismRecords/index')),
						array('label'=>'First Communion','url'=>array('/firstCommunionRecords/index')),
						array('label'=>'Confirmation','url'=>array('/confirmationRecords/index')),
						array('label'=>'Marriage','url'=>array('/marriageRecords/index')),
						array('label'=>'Banns','url'=>array('/bannsRecords/index')),
						array('label'=>'Death','url'=>array('/deathRecords/index')),
					)),
					array('label'=>'Certificates','visible'=>!Yii::app()->user->isGuest,'url'=>array('/site/page','view'=>'certificates'),'items'=>array(
						array('label'=>'Baptism','url'=>array('/baptismCertificate/index')),
						array('label'=>'First Communion','url'=>array('/firstCommunionCertificate/index')),
						array('label'=>'Confirmation','url'=>array('/confirmationCertificate/index')),
						array('label'=>'Marriage','url'=>array('/marriageCertificate/index')),
						array('label'=>'Death','url'=>array('/deathCertificate/index')),
						array('label'=>'Banns Letters','items'=>array(
							array('label'=>'Request','url'=>array('bannsRequest/index')),
							array('label'=>'Response','url'=>array('bannsResponse/index')),
							array('label'=>'No Impediment','url'=>array('noImpedimentLetter/index')),
						)),
					)),
				)),
				array('label'=>'Admin', 'url'=>array('/site/page', 'view' => 'admin'), 'visible' => Yii::app()->user->checkAccess('Pastor'), 'items'=>array(
					array('label'=>'Parish','url'=>array('/site/config'),'items'=>array(
						array('label'=>'Parish Config','url'=>array('/site/config')),
						array('label'=>'Pastors','url'=>array('/pastor/admin')),
						array('label'=>'Mass Schedule','url'=>array('/massSchedule/index')),
						array('label'=>'Zones','url'=>array('/fieldValue/admin', 'type'=>'zones')),
					)),
					array('label'=>'Users','url'=>array('/user/admin'), 'items'=>array(
						array('label'=>'Manage','url'=>array('/user/admin')),
						array('label'=>'Role Assignments','url'=>array('/rights/assignment/view')),
						array('label'=>'Permissions','url'=>array('/rights/authItem/permissions')),
						array('label'=>'Roles','url'=>array('/rights/authItem/roles')),
					)),
					array('label'=>'Fields','items'=>array(
						array('label'=>'Languages','url'=>array('/fieldValue/admin', 'type'=>'languages')),
						array('label'=>'Education','url'=>array('/fieldValue/admin', 'type'=>'education')),
						array('label'=>'Domicile Statuses','url'=>array('/fieldValue/admin', 'type'=>'domicile_status')),
						array('label'=>'Rite','url'=>array('/fieldValue/admin', 'type'=>'rite')),
						array('label'=>'Monthly Household Income','url'=>array('/fieldValue/admin', 'type'=>'monthly_household_income')),
					)),
					array('label'=>'Survey', 'items'=>array(
						array('label'=>'Need Level','url'=>array('/fieldValue/admin', 'type'=>'need_level')),
						array('label'=>'Satisfaction Level','url'=>array('/fieldValue/admin', 'type'=>'satisfaction_level')),
						array('label'=>'Awareness Level','url'=>array('/fieldValue/admin', 'type'=>'awareness_level')),
					)),
				)),
				array('label'=>'Reports', 'url'=>array('/reports/index'), 'visible' => Yii::app()->user->checkAccess('Pastor'), 'items' => array(
					array('label'=>'Birthdays', 'url'=>array('/reports/birthdays')),
					array('label'=>'Anniversaries', 'url'=>array('/reports/anniversaries')),
					array('label'=>'Mass Bookings', 'url'=>array('/reports/massBookings')),
					array('label'=>'Survey', 'url'=>array('/surveyReports'), 'items' => array(
						array('label'=>'Needs', 'url'=>array('/surveyReports/needs')),
						array('label'=>'Satisfaction', 'url'=>array('/surveyReports/satisfaction')),
						array('label'=>'Awareness', 'url'=>array('/surveyReports/awareness')),
						array('label'=>'Open Questions', 'url'=>array('/surveyReports/openQuestions')),
					)),
				)),
				array('label'=>'Finances', 'url'=>array('finance/index'), 'items'=>array(
					array('label'=>'Accounts','url'=>array('/account/index'), 'visible'=>Yii::app()->user->checkAccess('Account.Admin'),'items'=>array(
						array('label'=>'View Accounts','url'=>array('/account/index')),
						array('label'=>'Manage','url'=>array('/account/admin')),
						array('label'=>'Create','url'=>array('/account/create')),
					)),
					array('label'=>'Account Statement', 'url'=>array('/reports/accountStatement'), 'visible'=>Yii::app()->user->checkAccess('Reports.AccountStatement')),
					array('label'=>'Account Summary', 'url'=>array('/reports/accountSummary'), 'visible'=>Yii::app()->user->checkAccess('Reports.AccountSummary')),
					array('label'=>'Transactions', array('/transaction/index'), 'visible'=>Yii::app()->user->checkAccess('Transaction.Admin'),'items'=>array(
						array('label'=>'View Transactions','url'=>array('/transaction/index')),
						array('label'=>'Manage Transactions','url'=>array('/transaction/admin')),
						array('label'=>'Create Transaction','url'=>array('/transaction/create')),
					)),
					array('label'=>'Create Collection','url'=>array('/collection/create'),'visible'=>Yii::app()->user->checkAccess('Collection.Create')),
					array('label'=>'Create Transaction','url'=>array('/transaction/create'),'visible'=>!Yii::app()->user->checkAccess('Transaction.Admin')),
					array('label'=>'View Transactions','url'=>array('/transaction/index')),
				)),
				array('label'=>'Help', 'url'=>array('/site/page', 'view'=>'help')),
				array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Profile', 'url'=>array('/profile'), 'visible'=>!Yii::app()->user->isGuest, 'items' => array(
					array('label'=>'My Profile', 'url'=>array('/profile/index'), 'visible'=>!Yii::app()->user->isGuest),
					array('label'=>'Change Password', 'url'=>array('/profile/changePassword'), 'visible' => !Yii::app()->user->isGuest),
					array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible' => !Yii::app()->user->isGuest),
				)),
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
		<a href="http://www.aliveparish.com">Alive Parish</a> <?php $vfile = dirname(__FILE__) . '/../../../VERSION.txt';
			if (file_exists($vfile)) {
				$ver_full = file_get_contents($vfile);
				$ver = preg_replace('/-g.*$/', '', $ver_full);
				echo "<acronym title='$ver_full'>$ver</acronym>";
			} ?>&nbsp;| Copyright &copy;<?php echo date('Y'); ?>, <a href="http://www.rmcbangalore.com">Redemptorist Media Center</a>.<br/>
	</div><!-- footer -->

</div><!-- page -->

<script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en', includedLanguages: 'hi,kn,ta', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
}
</script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
</body>
</html>

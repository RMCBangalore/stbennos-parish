<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
	<meta name="google-translate-customization" content="9f0a39c0ffb3999c-c69ffe8bb987a246-g8a007ae370513f5f-c"></meta>

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
			if ($parish->logo_src) {
				echo CHtml::link(CHtml::image(Yii::app()->request->baseUrl . $parish->logo_src,
					CHtml::encode(Yii::app()->name),
						array('width' => $parish->logo_width, 'height' => $parish->logo_height)),
					array('/'));
		   } else {
				echo CHtml::link(CHtml::image(Yii::app()->request->baseUrl . '/images/logo-new.png',
					CHtml::encode(Yii::app()->name),
						array('width' => 405, 'height' => 100)), array('/'));
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
		Copyright &copy; <?php echo date('Y'); ?>, Redemptorist Media Center.<br/>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>

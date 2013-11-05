<div id="content">

<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<?php if (Yii::app()->user->isGuest) { ?>
<h1>Welcome!!</h1>

<div class="welcome">
  <ul>
	<li>One-stop place to manage your parish data.</li>
	<li>A software that can make your parish administration very effective.</li>
	<li>Developed with latest technology and cutting edge features.</li>
	<li>User friendly operations and functionality.</li>
  </ul>
Registered User?
<?php echo CHtml::link('Login', array('/site/login')); ?>

</div>
<?php } else { ?>

<h1>Welcome to <i><?php echo CHtml::encode(Parish::get_name()); ?></i></h1>

<?php

$iconMenu = Yii::app()->params['iconMenu'];
foreach($iconMenu as $icon) {
	if (isset($icon['role'])) {
		$role = $icon['role'];
		if (preg_match('/^!/', $role)) {
			$role = preg_replace('/^!/', '', $role);
			if (Yii::app()->user->checkAccess($role)) {
				continue;
			}
		} elseif (!Yii::app()->user->checkAccess($role)) {
			continue;
		}
	}
	$iconUrl = $icon['url'];
	if (isset($iconUrl[1])) {
		echo CHtml::link(CHtml::image(Yii::app()->baseUrl . $icon['icon'], $icon['title']),
			Yii::app()->createUrl($iconUrl[0], $iconUrl[1]));
	} else {
		echo CHtml::link(CHtml::image(Yii::app()->baseUrl . $icon['icon'], $icon['title']),
			Yii::app()->createUrl($iconUrl[0]));
	}
}

} ?>

<p>
</div>

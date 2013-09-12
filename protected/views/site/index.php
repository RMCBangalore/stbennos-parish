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

<h1>Welcome to <i><?php echo CHtml::encode(Yii::app()->params['parishName']); ?></i></h1>

<?php

$iconMenu = Yii::app()->params['iconMenu'];
foreach($iconMenu as $icon) {
	echo CHtml::link(CHtml::image(Yii::app()->baseUrl . $icon['icon'], $icon['title']), $icon['url']);
}

} ?>

<p>

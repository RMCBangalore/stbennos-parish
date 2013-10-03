<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;

$this->breadcrumbs = array(
	'Parish Profile'
);
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

<table>
<thead>
	<tr>
		<th>Parish Profile</th>
		<th>Operations</th>
	</tr>
</thead>
<tr>
<td>
<p>
</p><p>
<?php echo CHtml::link("Total $families families", array('family/index')); ?>
</p><p>
<?php echo CHtml::link("Total $members members", array('person/index'));
if ($baptised == $members) {
	echo ", " . CHtml::link("$baptised baptised", array('person/baptised'));;
} else {
	echo "</p><p>";
	echo CHtml::link("Total $baptised baptised", array('person/baptised'));
} ?>
</p><p>
<?php echo CHtml::link("$confirmed members confirmed", array('person/confirmed')) ?>
</p><p>
<?php echo CHtml::link("$married members married", array('person/married')) ?>
</p>
</td>
<td valign="top">
<p>
<?php echo CHtml::link('Mass Bookings', array('massBooking/index')) ?>
</p><p>
<?php echo CHtml::link("Manage Families", array('family/admin')); ?>
</p><p>
<?php echo CHtml::link("Manage Registers", array('site/page', 'view' => 'registers')); ?>
</p><p>
<?php echo CHtml::link("View Certificate Archives", array('site/page', 'view' => 'certificates')); ?>
</p>
</td>
</tr>
</table>
<?php } ?>

<p>

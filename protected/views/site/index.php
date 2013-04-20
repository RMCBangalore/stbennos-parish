<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<h1>Welcome to <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>

<?php if (Yii::app()->user->isGuest) { ?>
<p>
  <ul>
	<li>Extremely fast and scalable to multiple simultaneous connections</li>
	<li>Access from any platform - Windows, Linux, MAC, tablets, etc</li>
	<li>Easy to create, update, search family data records</li>
	<li>Multiple degrees of access control for pastors, staff, users</li>
	<li>Secure authentication using crypt to prevent cracker attacks</li>
  </ul>
</p>
<?php } else { ?>
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
<?php if (Yii::app()->user->checkAccess('Admin')) {
	echo CHtml::link("Total $members members", array('person/index'));
} else {
	echo "Total $members members";
}
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
<?php echo CHtml::link("View Families", array('family/index')) ?>
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

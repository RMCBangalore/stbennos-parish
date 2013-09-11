<?php
/* @var $this SatisfactionItemsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Admin' => array('site/page', 'view' => 'admin'),
	'Satisfaction Items',
);

?>

<table>
<?php $satisfactionModel = new SatisfactionData();
$satisfactionLevels = FieldNames::values('satisfaction_level') ?>

<thead>
	<tr>
		<th>&nbsp;</th>
<?php foreach($satisfactionLevels as $level) {
	echo '<th>' . $level . '</th>';
} ?>
		<th>
	</tr>
</thead>

<?php foreach($satisfactionItems as $data) { ?>
	
	<th><?php echo CHtml::encode($data->text); ?>:</th>

	<?php $sid = $data->id;

		foreach ($satisfactionLevels as $code => $level) {
			$chk = "";
			if (isset($satisfactionData[$sid]) and $code == $satisfactionData[$sid]) {
				$chk = "checked='true' ";
			}

			echo "<td><input type=\"radio\" id=\"SatisfactionData_${sid}_satisfaction_value_{$code}\" name=\"SatisfactionData[$sid][satisfaction_value]\" value=\"$code\" $chk/></td>"; 
		} ?>
	</tr>
<?php } ?>
</table>


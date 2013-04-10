<?php
/* @var $this NeedItemsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Need Items',
);

?>

<table>
<?php $needModel = new NeedData();
$needLevels = FieldNames::values('need_level') ?>

<thead>
	<tr>
		<th>&nbsp;</th>
<?php foreach($needLevels as $level) {
	echo '<th>' . $level . '</th>';
} ?>
		<th>
	</tr>
</thead>

<?php foreach($needItems as $data) { ?>
	
	<th><?php echo CHtml::encode($data->text); ?>:</th>

	<?php $nid = $data->id;
		foreach ($needLevels as $code => $level) {
			$chk = "";
			if (isset($needData[$nid]) and $code == $needData[$nid]) {
				$chk = "checked='true' ";
			}
			echo "<td><input type=\"radio\" id=\"NeedData_${nid}_need_value_{$code}\" name=\"NeedData[$nid][need_value]\" value=\"$code\" $chk/></td>"; 
		} ?>
	</tr>
<?php } ?>
</table>


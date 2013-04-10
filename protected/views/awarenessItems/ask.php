<?php
/* @var $this AwarenessItemsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Awareness Items',
);

?>

<table>
<?php $awarenessModel = new AwarenessData(); ?>

<thead>
	<tr>
		<th>&nbsp;</th>
			<th>Accessed</th>
			<th>Aware</th>
		<th>
	</tr>
</thead>

<?php foreach($awarenessItems as $data) { ?>
	
	<th><?php echo CHtml::encode($data->text); ?>:</th>

	<?php $sid = $data->id;

		foreach (array('accessed', 'aware') as $attr) {
			$chk = "";
			if (isset($awarenessData[$sid][$attr])) {
				$chk = "checked='true' ";
			}

			echo "<td><input type=\"checkbox\" id=\"AwarenessData_${sid}_awareness_value_{$attr}\" name=\"AwarenessData[$sid][$attr]\" value=\"1\" $chk/></td>"; 
		} ?>
	</tr>
<?php } ?>
</table>


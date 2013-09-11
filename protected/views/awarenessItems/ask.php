<?php
/* @var $this AwarenessItemsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Admin' => array('site/page', 'view' => 'admin'),
	'Awareness Items',
);

#echo CHtml::hiddenField("AwarenessData", 1);

?>

<table>
<?php $awarenessModel = new AwarenessData(); ?>

<thead>
	<tr>
		<th>&nbsp;</th>
		<?php
			 $fv = FieldNames::values('awareness_level');
			 foreach ($fv as $aid => $attr) {
				 echo '<th>' . $attr . '</th>';
			 }
		?>
	</tr>
</thead>

<?php

foreach($awarenessItems as $data) { ?>
	
	<th><?php echo CHtml::encode($data->text); ?>:</th>

	<?php $sid = $data->id;

		$fv = FieldNames::values('awareness_level');
		foreach ($fv as $fid => $attr) {
			$chk = isset($awarenessData[$sid]) ? $awarenessData[$sid] == $fid : false;
			echo '<td>';
			echo CHtml::radioButton("AwarenessData[$sid]", $chk, array('id' => "AwarenessData_${sid}_value_{$fid}", 'value' => $fid));
			echo "</td>"; 
		} ?>
	</tr>
<?php } ?>
</table>


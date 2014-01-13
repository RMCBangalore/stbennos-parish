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


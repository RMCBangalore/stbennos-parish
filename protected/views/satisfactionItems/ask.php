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


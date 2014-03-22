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
/* @var $this FamilyController */
/* @var $data Families */
?>

<div class="view">

	<div class="ident">
<?php
	echo "<span class='id'>" . CHtml::encode('Family #' . $data->id) . '</span>, ';
	if ($data->head()) {
		$head = $data->head();
		echo 'head: <span class="head">';
		echo CHtml::encode($head->fullname()) . "</span>, ";
	} 

	$unit = $data->unit;
	if ($unit->reg_date) {
		echo '<span class="reg-date">' . CHtml::encode('reg: ');
		echo '<span class="val">' . $unit->reg_date . '</span>';
		echo '</span>, ';
	}

	?>

	<?php
		$nc = count($data->children());
		if ($nc) {
			echo '<span class="children">' . CHtml::encode($nc) . '</span> ';
			echo CHtml::encode('children');
		} else {
			echo CHtml::encode('No children');
		}
		echo ', ';

		if ($data->dependents()) {
			echo '<span class="dependents">' . CHtml::encode(count($data->dependents())) . '</span> ';
			echo CHtml::encode('dependents');
		}
	?>

	</div>

	<div class="numbers">
	<?php if ($unit->phone) {
		echo '<span class="phone">';
	echo '<span class="val">' . CHtml::encode($unit->phone) . '</span>, ';
	echo '</span>';
	}
	if ($unit->mobile) {
		echo '<span class="mobile">';
		echo '<span class="val">' . CHtml::encode($unit->mobile).'</span>';
		echo '</span>, ';
	}
	if ($unit->email) {
		echo '<span class="email">';
		echo '<span class="val">' . CHtml::encode($unit->email).'</span>';
		echo '</span>, ';
	}
	echo 'Zone <span class="zone">' . FieldNames::value('zones', $unit->zone) . '</span>, ';
	?>

	<?php echo CHtml::encode('Code'); ?>:
	<span class="fid"><?php echo CHtml::encode($unit->uid); ?></span>

	<?php if ($unit->bpl_card) {
		echo ', <span class="bpl">BPL Card</span>';
	} ?>
	</div>

	<div class="address">
	<span class="field nm"><?php echo CHtml::encode($unit->addr_nm) . ', '; ?></span>
	<span class="field stt"><?php echo CHtml::encode($unit->addr_stt); ?></span>
	<br />

	<span class="field area"><?php echo CHtml::encode($unit->addr_area); ?></span>
	 - 
	<span class="field pin"><?php echo CHtml::encode($unit->addr_pin); ?></span>
	<br />
	</div>

	<div class="marriage">
		Married <span class="dt"><?php echo CHtml::encode($data->marriage_date); ?></span> at 
			<span class="church"><?php echo CHtml::encode($data->marriage_church); ?></span>.
			Type: <span class="type"><?php echo CHtml::encode(FieldNames::value('marriage_type', $data->marriage_type)); ?></span>, 
			Status: <span class="status"><?php echo CHtml::encode(FieldNames::value('marriage_status', $data->marriage_status)); ?></span>
	</div>
	
	<?php if ($unit->monthly_income) {
		echo '<span class="label">' . CHtml::encode($unit->getAttributeLabel('monthly_income')) . ': </span>';
		echo '<span class="income">' . CHtml::encode(FieldNames::value('monthly_household_income', $unit->monthly_income)) . '</span>';
	} ?>


</div>

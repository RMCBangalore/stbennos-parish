<?php
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

	if ($data->reg_date) {
		echo '<span class="reg-date">' . CHtml::encode('reg: ');
		echo '<span class="val">' . $data->reg_date . '</span>';
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
	<?php if ($data->phone) {
		echo '<span class="phone">';
	echo '<span class="val">' . CHtml::encode($data->phone) . '</span>, ';
	echo '</span>';
	}
	if ($data->mobile) {
		echo '<span class="mobile">';
		echo '<span class="val">' . CHtml::encode($data->mobile).'</span>';
		echo '</span>, ';
	}
	if ($data->email) {
		echo '<span class="email">';
		echo '<span class="val">' . CHtml::encode($data->email).'</span>';
		echo '</span>, ';
	}
	echo 'Zone <span class="zone">' . FieldNames::value('zones', $data->zone) . '</span>, ';
	?>

	<?php echo CHtml::encode('Code'); ?>:
	<span class="fid"><?php echo CHtml::encode($data->fid); ?></span>

	<?php if ($data->bpl_card) {
		echo ', <span class="bpl">BPL Card</span>';
	} ?>
	</div>

	<div class="address">
	<span class="field nm"><?php echo CHtml::encode($data->addr_nm) . ', '; ?></span>
	<span class="field stt"><?php echo CHtml::encode($data->addr_stt); ?></span>
	<br />

	<span class="field area"><?php echo CHtml::encode($data->addr_area); ?></span>
	 - 
	<span class="field pin"><?php echo CHtml::encode($data->addr_pin); ?></span>
	<br />
	</div>

	<div class="marriage">
		Married <span class="dt"><?php echo CHtml::encode($data->marriage_date); ?></span> at 
			<span class="church"><?php echo CHtml::encode($data->marriage_church); ?></span>.
			Type: <span class="type"><?php echo CHtml::encode(FieldNames::value('marriage_type', $data->marriage_type)); ?></span>, 
			Status: <span class="status"><?php echo CHtml::encode(FieldNames::value('marriage_status', $data->marriage_status)); ?></span>
	</div>
	
	<?php if ($data->monthly_income) {
		echo '<span class="label">' . CHtml::encode($data->getAttributeLabel('monthly_income')) . ': </span>';
		echo '<span class="income">' . CHtml::encode(FieldNames::value('monthly_household_income', $data->monthly_income)) . '</span>';
	} ?>


</div>

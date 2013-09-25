<?php
/* @var $this FamilyController */
/* @var $data Families */
?>

<div class="view">

	<div class="ident">
	<?php if ($data->head()) {
		$head = $data->head();
		echo '<span class="head">';
		echo CHtml::link(CHtml::encode($head->fullname()), array('view', 'id' => $data->id)) . "</span>";
		echo "'s family: ";
		echo '<span class="id">' . CHtml::encode('#' . $data->id) . '</span>, ';
	} else {
		echo "<span class='id'>" . CHtml::link(CHtml::encode('Family #' . $data->id), array('view', 'id' => $data->id)) . '</span>, ';
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

	<?php /*

	<b><?php echo CHtml::encode($data->getAttributeLabel('marriage_church')); ?>:</b>
	<?php echo CHtml::encode($data->marriage_church); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('marriage_date')); ?>:</b>
	<?php echo CHtml::encode($data->marriage_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('marriage_type')); ?>:</b>
	<?php echo CHtml::encode($data->marriage_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('marriage_status')); ?>:</b>
	<?php echo CHtml::encode($data->marriage_status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('monthly_income')); ?>:</b>
	<?php echo CHtml::encode($data->monthly_income); ?>
	<br />

	*/ ?>


</div>

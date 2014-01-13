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
/* @var $this PersonController */
/* @var $data People */
?>

<div class="person view">

	<?php if (!$data) { ?>
		No data exists
	<?php } else { ?>

<div class="photo">
<?php
	if ($data->photo) {
		$photo_path = "/images/members/" . $data->photo;
	} else {
		$sex = $data->sex ? strtolower(FieldNames::value('sex', $data->sex)) : 'generic';
		$photo_path = "/images/member-photo-$sex.jpg";
	}
	$src = Yii::app()->request->baseUrl . $photo_path;
	list($width, $height) = getimagesize(".$photo_path");
	$width = $width * 120 / $height;
	$height = 120;
	$alt = $data->fname . "'s photo";
	echo CHtml::image($src, $alt, array('width' => $width, 'height' => $height));

	foreach(array('sex', 'domicile_status', 'education', 'lang_pri', 'lang_lit', 'lang_edu', 'rite') as $field) {
		if ($data->$field) {
			$key = $field;
			if (preg_match('/^lang/', $field)) {
				$key = 'languages';
			}
			$data->$field = FieldNames::value($key, $data->$field);
		}
	}
?>
</div>
<div class="fields">
<span class="head"><?php echo CHtml::link($data->fullname() . ': #' . $data->id, array('/person/view', 'id'=>$data->id)); ?></span>

<?php
	if ($data->profession or $data->occupation) {
		echo "<div>";
		if ($data->profession) {
			$ttxt = $data->occupation ? " title='$data->profession ( $data->occupation )'" : "";
			echo "<span class='val'$ttxt>". $data->profession .($ttxt ? "..." : "")."</span>";
		} else {
			echo "<span class='val'>". $data->occupation ."</span>";
		}
		echo "</div>";
	} elseif ($data->education) {
		echo "<div>";
		echo "<span class='val'>". $data->education ."</span>";
		echo "</div>";
	}

	$f_id = null;
	if ($data->mid) {
		echo "<div>";
		$f_id = 1;
		echo "<label>MID: </label>";
		echo "<span class='val'>".$data->mid."</span>, ";
	}

	if ($data->dob) {
		if (!$f_id) {
			echo "<div class='ident'>";
		}
		echo "<label>Born:</label> ";
		echo "<span class='val'>" . $data->dob . "</span>";
	}
	if ($f_id) {
		echo "</div>";
	}

	if ($data->mobile) {
		echo '<span class="mobile">';
		echo '<span class="val">' . CHtml::encode($data->mobile).'</span>';
		echo '</span>';
	}

	if ($data->email) {
		echo ', <span class="email">';
		$mail = $data->email;
		$val = substr($mail, 0, 5) . '..';
		echo "<span class='val' title='$mail'>" . CHtml::encode($val).'</span>';
		echo '</span>';
	}

	if ($data->baptism_dt) {
		echo "<div class='baptism'><label>Baptised:</label> ";
		echo "<span class='val'>" . $data->baptism_dt . "</span>";
		echo "</div>";
	}


	if ($data->marriage_dt) {
		echo "<div class='marriage'><label>Married:</label> ";
		echo "<span class='val'>" . $data->marriage_dt . "</span>";
		echo "</div>";
	} elseif ($data->confirmation_dt) {
		echo "<div class='confirmation'><label>Confirmed:</label> ";
		echo "<span class='val'>" . $data->confirmation_dt . "</span>";
		echo "</div>";
	}

	if ($data->death_dt) {
		echo "<div class='death'><label>Died:</label> ";
		echo "<span class='val'>" . $data->death_dt . "</span>";
		if ($data->cemetery_church) {
				echo "<label>Cemetery Church: </label>";
				echo "<span class='val'>". $data->cemetery_church ."</span>";
		}
		echo "</div>";
	} else {
		echo "<div class='languages'>";
		echo "<label>Primary Language: </label>";
		echo "<span class='val'>". $data->lang_pri . "</span><br>";
		echo "</div>";
	}
?>

</div>
	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('/person/view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mid')); ?>:</b>
	<?php echo CHtml::encode($data->mid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fname')); ?>:</b>
	<?php echo CHtml::encode($data->fname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lname')); ?>:</b>
	<?php echo CHtml::encode($data->lname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sex')); ?>:</b>
	<?php echo CHtml::encode(isset($data->sex) ? FieldNames::value('sex', $data->sex) : ''); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('domicile_status')); ?>:</b>
	<?php echo $data->domicile_status ? CHtml::encode(FieldNames::value('domicile_status', $data->domicile_status)) : ''; ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dob')); ?>:</b>
	<?php echo CHtml::encode($data->dob); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('education')); ?>:</b>
	<?php echo CHtml::encode(isset($data->education) ? FieldNames::value('education', $data->education) : ''); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('profession')); ?>:</b>
	<?php echo CHtml::encode($data->profession); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('occupation')); ?>:</b>
	<?php echo CHtml::encode($data->occupation); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mobile')); ?>:</b>
	<?php echo CHtml::encode($data->mobile); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lang_pri')); ?>:</b>
	<?php echo CHtml::encode($data->lang_pri); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lang_lit')); ?>:</b>
	<?php echo CHtml::encode($data->lang_lit); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lang_edu')); ?>:</b>
	<?php echo CHtml::encode($data->lang_edu); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rite')); ?>:</b>
	<?php echo CHtml::encode($data->rite); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('baptism_dt')); ?>:</b>
	<?php echo CHtml::encode($data->baptism_dt); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('baptism_church')); ?>:</b>
	<?php echo CHtml::encode($data->baptism_church); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('baptism_place')); ?>:</b>
	<?php echo CHtml::encode($data->baptism_place); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('god_parents')); ?>:</b>
	<?php echo CHtml::encode($data->god_parents); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('first_comm_dt')); ?>:</b>
	<?php echo CHtml::encode($data->first_comm_dt); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('confirmation_dt')); ?>:</b>
	<?php echo CHtml::encode($data->confirmation_dt); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('marriage_dt')); ?>:</b>
	<?php echo CHtml::encode($data->marriage_dt); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cemetery_church')); ?>:</b>
	<?php echo CHtml::encode($data->cemetery_church); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('family_id')); ?>:</b>
	<?php echo CHtml::encode($data->family_id); ?>
	<br />

	*/ ?>
	<?php } ?>

</div>

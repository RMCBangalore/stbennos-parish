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
/* @var $model People */

$this->breadcrumbs=array(
	'People'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List People', 'url'=>array('index')),
	array('label'=>'Update People', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete People', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage People', 'url'=>array('admin')),
);
?>

<h1><?php echo $model->fullname() . ': #' . $model->id; ?></h1>

<div class="view">
<div class="photo">
<?php
	if ($model->photo) {
		$src = Yii::app()->request->baseUrl . '/images/members/' . $model->photo;
		list($width, $height) = getimagesize("./images/members/" . $model->photo);
		$label = 'Update Photo';
	} else {
		$sex = $model->sex ? strtolower(FieldNames::value('sex', $model->sex)) : 'generic';
		$photo_path = "/images/member-photo-$sex.jpg";
		$src = Yii::app()->request->baseUrl . $photo_path;
		list($width, $height) = getimagesize(".$photo_path");
		$label = 'Upload Photo';
	}
	$alt = $model->fname . "'s photo";
	echo CHtml::image($src, $alt, array('width' => $width, 'height' => $height));
	echo "<p>";
	echo CHtml::link($label, array('photo', 'id'=>$model->id));
	echo "</p>";

	foreach(array('sex', 'domicile_status', 'education', 'lang_pri', 'lang_lit', 'lang_edu', 'rite') as $field) {
		if ($model->$field) {
			$key = $field;
			if (preg_match('/^lang/', $field)) {
				$key = 'languages';
			}
			$model->$field = FieldNames::value($key, $model->$field);
		}
	}
?>
</div>
<div class="fields">
<?php
	if ($model->profession or $model->occupation) {
		echo "<div>";
		if ($model->profession) {
			echo "<span class='val'>". $model->profession ."</span>";
			if ($model->occupation) {
				echo " (<span class='val'>". $model->occupation ."</span>)";
			}
		} else {
			echo "<span class='val'>". $model->occupation ."</span>";
		}
		echo "</div>";
	} elseif ($model->education) {
		echo "<div>";
		echo "<span class='val'>". $model->education ."</span>";
		echo "</div>";
	}

	$f_id = null;
	if ($model->mid) {
		echo "<div class='ident'>";
		$f_id = 1;
		echo "<label>MID: </label>";
		echo "<span class='val'>".$model->mid."</span>, ";
	}

	if ($model->dob) {
		if (!$f_id) {
			echo "<div class='ident'>";
		}
		echo "<label>Born:</label> ";
		echo "<span class='val'>" . $model->dob . "</span>";
	}
	if ($f_id) {
		echo "</div>";
	}

	if ($model->domicile_status != 'Home') {
		echo "<span class='domicile_status'><label>Domicile Status: </label>";
		echo "<span class='val'>" . $model->domicile_status . "</span>";
		echo "</span>";
	}

	if ($model->mobile) {
		echo '<span class="mobile">';
		echo '<span class="val">' . CHtml::encode($model->mobile).'</span>';
		echo '</span>, ';
	}

	if ($model->email) {
		echo '<span class="email">';
		echo '<span class="val">' . CHtml::encode($model->email).'</span>';
		echo '</span>';
	}

	if ($model->baptism_dt) {
		echo "<div class='baptism'><label>Baptised:</label> ";
		echo "<span class='val'>" . $model->baptism_dt . "</span>";
		echo " @ <span class='place'>" . $model->baptism_place . "</span><br>";
		echo "<label>Church:</label> ";
		echo "<span class='val'>" . $model->baptism_church . "</span><br>";
		echo "<label>God parents:</label> ";
		echo "<span class='val'>" . $model->god_parents . "</span>";
		echo "</div>";
	}

	if ($model->first_comm_dt) {
		echo "<div class='first-communion'><label>First Communion:</label> ";
		echo "<span class='val'>" . $model->first_comm_dt . "</span>";
		echo "</div>";
	}

	if ($model->confirmation_dt) {
		echo "<div class='confirmation'><label>Confirmed:</label> ";
		echo "<span class='val'>" . $model->confirmation_dt . "</span>";
		echo "</div>";
	}

	if ($model->marriage_dt) {
		echo "<div class='marriage'><label>Married:</label> ";
		echo "<span class='val'>" . $model->marriage_dt . "</span>";
		echo "</div>";
	}

	if ($model->death_dt) {
		echo "<div class='death'><label>Died:</label> ";
		echo "<span class='val'>" . $model->death_dt . "</span>";
		if ($model->cemetery_church) {
				echo "<label>Cemetery Church: </label>";
				echo "<span class='val'>". $model->cemetery_church ."</span>";
		}
		echo "</div>";
	}

	echo "<div class='languages'>";
	echo "<label>Primary Language: </label>";
	echo "<span class='val'>". $model->lang_pri . "</span><br>";
	echo "<label>Liturgy: </label>";
	echo "<span class='val'>". $model->lang_lit . "</span>, ";
	echo "<label>Education: </label>";
	echo "<span class='val'>". $model->lang_edu . "</span>";
	echo "</div>";
	echo CHtml::link('Edit', array('update', 'id'=>$model->id)) . ' | ' . 
	  CHtml::link('Create Certificate', array('membershipCertificate/create', 'id' => $model->id)) . ' | ' .
	  CHtml::link('View Family', array('/family/view', 'id'=>$model->family_id));
?>

</div>
</div>

<?php
/*
$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'mid',
		'fname',
		'lname',
		'sex',
		'domicile_status',
		'dob',
		'education',
		'profession',
		'occupation',
		'mobile',
		'email',
		'lang_pri',
		'lang_lit',
		'lang_edu',
		'rite',
		'baptism_dt',
		'baptism_church',
		'baptism_place',
		'god_parents',
		'first_comm_dt',
		'confirmation_dt',
		'marriage_dt',
		'cemetery_church',
		'family_id',
	),
)); */ ?>


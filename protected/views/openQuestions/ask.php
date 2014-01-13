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
/* @var $this OpenQuestionsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Admin' => array('site/page', 'view' => 'admin'),
	'Open Questions',
);

?>

<?php
$openModels = array();
foreach($openData as $openModel) {
	$openModels[$openModel->question_id] = $openModel;
}
?>

<table>

<?php foreach($openQuestions as $data) { ?>
	
	<tr>
		<th><?php echo CHtml::encode($data->text); ?>:</th>

	<?php $qid = $data->id;
		
		$openModel = isset($openModels[$qid]) ? $openModels[$qid] : new OpenData();
		
		echo '<td>';

		switch ($data->type) {
		case 'yesno': echo $form->dropDownList($openModel, "[$qid]value", 
			array('no' => 'No', 'yes' => 'Yes'), array('prompt' => '-- Select --'));
			break;
		case 'integer': echo $form->textField($openModel, "[$qid]value",
			array('size' => 5, 'maxlength' => 50));
			break;
		case 'string': echo $form->textField($openModel, "[$qid]value",
			array('size' => 15, 'maxlength' => 50));
			break;
		}

		echo '</td>';

	?>

	</tr>
<?php } ?>
</table>


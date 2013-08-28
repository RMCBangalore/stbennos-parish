<?php
/* @var $this OpenQuestionsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
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


<?php

class SurveyReportsController extends RController
{
	public function actionAwareness()
	{
		$this->render('awareness');
	}

	public function actionIndex()
	{
		$this->render('index');
	}

	public function actionNeeds()
	{
		$needItems = NeedItem::model()->findAll();

		if (isset($_GET['need_id'])) {
			$need_id = $_GET['need_id'];
			Yii::trace("SR.actionNeeds called for $need_id", 'application.controllers.SurveyReportsController');

			if (strlen($need_id) > 0) {
				$crit = array(
							'need_id' => $need_id
						);
			} else {
				$crit = array();
			}

			$needDist = NeedData::model()->findAllByAttributes($crit, array(
								'select' => 'need_id, need_value, count(id) val_count',
								'group' => 'need_id, need_value'
							));

			$this->renderPartial('need_report', array(
				'needDist' => $needDist,
				'needItems' => $needItems
			));

			return;
		}

		$this->render('needs', array(
			'needItems' => $needItems
		));
	}

	public function actionOpenQuestions()
	{
		$this->render('openQuestions');
	}

	public function actionSatisfaction()
	{
		$satisfactionItems = SatisfactionItem::model()->findAll();

		if (isset($_GET['satisfaction_item_id'])) {
			$satisfaction_item_id = $_GET['satisfaction_item_id'];
			Yii::trace("SR.satisfaction called for $satisfaction_item_id", 'application.controllers.SurveyReportsController');

			if (strlen($satisfaction_item_id) > 0) {
				$crit = array(
							'satisfaction_item_id' => $satisfaction_item_id
						);
			} else {
				$crit = array();
			}

			$satisfactionDist = SatisfactionData::model()->findAllByAttributes($crit, array(
								'select' => 'satisfaction_item_id, satisfaction_value, count(id) val_count',
								'group' => 'satisfaction_item_id, satisfaction_value'
							));

			$this->renderPartial('satisfaction_report', array(
				'satisfactionDist' => $satisfactionDist,
				'satisfactionItems' => $satisfactionItems
			));

			return;
		}

		$this->render('satisfaction', array(
			'satisfactionItems' => $satisfactionItems
		));
	}

	// Uncomment the following methods and override them if needed
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'rights',
		);
	}

	/*
	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}

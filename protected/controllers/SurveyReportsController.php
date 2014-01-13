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

class SurveyReportsController extends RController
{
	public function actionAwareness()
	{
		$awarenessItems = AwarenessItem::model()->findAll();

		if (isset($_GET['awareness_id'])) {
			$awareness_id = $_GET['awareness_id'];
			Yii::trace("SR.actionAwarenesss called for $awareness_id", 'application.controllers.SurveyReportsController');

			if (strlen($awareness_id) > 0) {
				$crit = array(
							'awareness_id' => $awareness_id
						);
			} else {
				$crit = array();
			}

			$awarenessDist = AwarenessData::model()->findAllByAttributes($crit, array(
								'select' => 'awareness_id, value, count(id) val_count',
								'group' => 'awareness_id, value'
							));

			$this->renderPartial('awareness_report', array(
				'awarenessDist' => $awarenessDist,
				'awarenessItems' => $awarenessItems
			));

			return;
		}

		$this->render('awareness', array(
			'awarenessItems' => $awarenessItems
		));
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
		$openQuestions = OpenQuestion::model()->findAll();

		if (isset($_GET['question_id'])) {
			$question_id = $_GET['question_id'];
			Yii::trace("SR.openQuestions called for '$question_id'", 'application.controllers.SurveyReportsController');

			if (preg_match('/^\d+$/', $question_id)) {
				$crit = array(
							'question_id' => $question_id
						);
			} elseif ('' == $question_id) {
				$questions = OpenQuestion::model()->findAllByAttributes(array(
					'type' => 'yesno'
				));
				$qids = array();
				foreach ($questions as $qn) {
					array_push($qids, $qn->id);
				}
				$crit = array(
							'question_id' => $qids
						);
			} else {
				return;
			}

			$openDist = OpenData::model()->findAllByAttributes($crit, array(
								'select' => 'question_id, value, count(id) val_count',
								'group' => 'question_id, value'
							));

			$this->renderPartial('questions_report', array(
				'openDist' => $openDist,
				'openQuestions' => $openQuestions
			));

			return;
		}

		$this->render('openQuestions', array(
			'openQuestions' => $openQuestions
		));
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

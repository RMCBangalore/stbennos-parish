<?php

class ReportsController extends RController
{
	public function actionAnniversaries()
	{
		$model = new People;

		if (isset($_POST['period'])) {
			header( "Content-Type: application/vnd.ms-excel; charset=utf-8" );
			header( "Content-Disposition: inline; filename=\"anniversaries-report.xls\"" );

			$dt = $_POST['People']['marriage_dt'];
			$period = $_POST['period'];
			$nxt_anni = "MAKEDATE(YEAR('$dt')+IF(DAYOFYEAR(t.dob)<DAYOFYEAR('$dt'),1,0),DAYOFYEAR(t.marriage_dt))";
			$cond = "$nxt_anni BETWEEN '$dt' AND '$dt' + INTERVAL 1 $period ORDER BY $nxt_anni";

			Yii::trace("R.anniversaries dt=$dt, period=$period, cond=$cond", 'application.controllers.ReportController');

			$crit = new CDbCriteria;
			$crit->addCondition($cond);
			$dataProvider = new CActiveDataProvider('People', array(
				'criteria' => $crit
			));
			$dataProvider->pagination = false;

			$fields = array('id', 'fname', 'lname', 'dob', 'marriage_dt', 'mobile');

			$labels = $model->attributeLabels();
			$fval = array();

			foreach($fields as $field) {
				array_push($fval, $labels[$field]);
			}
			echo implode("\t", $fval) . "\n";

            foreach( $dataProvider->data as $data ) {
				$fval = array();
				foreach($fields as $field) {
					array_push($fval, $data->$field);
				}
				echo implode("\t", $fval) . "\n";
			}

			Yii::app()->end();
			return;
		}

		$this->render('anniversaries', array(
			'model' => $model
		));
	}

	public function actionBirthdays()
	{
		$model = new People;

		if (isset($_POST['period'])) {
			header( "Content-Type: application/vnd.ms-excel; charset=utf-8" );
			header( "Content-Disposition: inline; filename=\"birthdays-report.xls\"" );

			$dt = $_POST['People']['dob'];
			$period = $_POST['period'];
			$nxt_bday = "MAKEDATE(YEAR('$dt')+IF(DAYOFYEAR(t.dob)<DAYOFYEAR('$dt'),1,0),DAYOFYEAR(t.dob))";
			$cond = "$nxt_bday BETWEEN '$dt' AND '$dt' + INTERVAL 1 $period ORDER BY $nxt_bday";

			Yii::trace("R.birthdays dt=$dt, period=$period, cond=$cond", 'application.controllers.ReportController');

			$crit = new CDbCriteria;
			$crit->addCondition($cond);
			$dataProvider = new CActiveDataProvider('People', array(
				'criteria' => $crit
			));
			$dataProvider->pagination = false;

			$fields = array('id', 'fname', 'lname', 'dob', 'mobile');

			$labels = $model->attributeLabels();
			$fval = array();

			foreach($fields as $field) {
				array_push($fval, $labels[$field]);
			}
			echo implode("\t", $fval) . "\n";

            foreach( $dataProvider->data as $data ) {
				$fval = array();
				foreach($fields as $field) {
					array_push($fval, $data->$field);
				}
				echo implode("\t", $fval) . "\n";
			}

			Yii::app()->end();
			return;
		}

		$this->render('birthdays', array(
			'model' => $model
		));
	}

	public function actionFamilies()
	{
		$this->render('families');
	}

	public function actionIndex()
	{
		$this->render('index');
	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

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

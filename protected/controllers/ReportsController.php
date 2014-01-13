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

class ReportsController extends RController
{
	public function actionParishProfile()
	{
		$fams = Families::model()->findAll();
		$ppl = People::model()->findAll();
		$baptised1 = BaptismRecord::model()->findAll('baptism_dt > NOW() - INTERVAL 1 YEAR AND dob > NOW() - INTERVAL 1 YEAR');
		$baptised7 = BaptismRecord::model()->findAll('baptism_dt > NOW() - INTERVAL 1 YEAR AND dob BETWEEN NOW() - INTERVAL 7 YEAR AND NOW() - INTERVAL 1 YEAR');
		$baptised7p = BaptismRecord::model()->findAll('baptism_dt > NOW() - INTERVAL 1 YEAR AND dob < NOW() - INTERVAL 7 YEAR');
		$baptised = BaptismRecord::model()->findAll();
		$confirmed = ConfirmationRecord::model()->findAll('confirmation_dt > NOW() - INTERVAL 1 YEAR ');
		$firstComm = FirstCommunionRecord::model()->findAll('communion_dt > NOW() - INTERVAL 1 YEAR ');
		$married = MarriageRecord::model()->findAll('marriage_dt > NOW() - INTERVAL 1 YEAR');
		$schedule = MassSchedule::model()->findAll(array(
			'order' => 'day, time'
		));


		$this->render('parish-profile', array(
			'families'	=> count($fams),
			'members'	=> count($ppl),
			'baptised'	=> count($baptised),
			'baptised1'	=> count($baptised1),
			'baptised7'	=> count($baptised7),
			'baptised7p'	=> count($baptised7p),
			'confirmed'	=> count($confirmed),
			'firstComm' => count($firstComm),
			'married'	=> count($married),
			'schedule'	=> $schedule
		));
	}

	public function actionAnniversaries()
	{
		$model = new People;

		if (isset($_POST['period'])) {
			header( "Content-Type: application/vnd.ms-excel; charset=utf-8" );
			header( "Content-Disposition: inline; filename=\"anniversaries-report.xls\"" );

			$dt = $_POST['People']['marriage_dt'];
			$dt = date('Y-m-d', CDateTimeParser::parse($dt, Yii::app()->locale->getDateFormat('short')));
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
			$dt = date('Y-m-d', CDateTimeParser::parse($dt, Yii::app()->locale->getDateFormat('short')));
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

	public function actionMassBookings()
	{
		$model = new MassBooking;

		if (isset($_POST['period'])) {
			$dt = $_POST['MassBooking']['mass_dt'];
			$dt = date('Y-m-d', CDateTimeParser::parse($dt, Yii::app()->locale->getDateFormat('short')));
			header( "Content-Type: application/vnd.ms-excel; charset=utf-8" );
			header( "Content-Disposition: inline; filename=\"mass-bookings-report-$dt.xls\"" );

			$period = $_POST['period'];
			$cond = "mass_dt BETWEEN '$dt' AND '$dt' + INTERVAL 1 $period ORDER BY mass_dt, mass.time, type";

			Yii::trace("R.massBookings dt=$dt, period=$period, cond=$cond", 'application.controllers.ReportController');

			$crit = new CDbCriteria;
			$crit->mergeWith(array(
				'join' => 'INNER JOIN masses mass ON mass.id = t.mass_id',
				'condition' => $cond
			));
			$dataProvider = new CActiveDataProvider('MassBooking', array(
				'criteria' => $crit
			));
			$dataProvider->pagination = false;

			$fields = array('mass_dt', 'mass' => array('time', 'language'), 'type', 'intention', 'booked_by');

			$labels = $model->attributeLabels();
			$fval = array();

			foreach($fields as $key => $val) {
				if (!preg_match('/^\d+$/', $key)) {
					foreach($val as $field) {
						array_push($fval, ucfirst($field));
					}
				} else {
					array_push($fval, $labels[$val]);
				}
			}
			echo implode("\t", $fval) . "\n";

			$last_dt = '';
			$last_mass = 0;
			$last_type = '';

			foreach( $dataProvider->data as $data ) {
				$fval = array();
				$this_dt = $data->mass_dt;
				$this_mass = $data->mass_id;
				$this_type = $data->type;
				$same_mass = false;
				$same_type = false;
				if ($this_dt == $last_dt and $this_mass == $last_mass) {
					$same_mass = true;
					if ($this_type == $last_type) {
						$same_type = true;
					}
				}
				foreach($fields as $key => $val) {
					if (!preg_match('/^\d+$/', $key)) {
						foreach($val as $field) {
							if ($same_mass) {
								$value = '';
							} elseif ('language' == $field) {
								$value = FieldNames::value('languages', $data->$key->$field);
							} else {
								$value = $data->$key->$field;
							}
							array_push($fval, $value);
						}
					} else {
						if ($this_dt == $last_dt and 'mass_dt' == $val) {
							$value = '';
						} elseif ($same_type and 'type' == $val) {
							$value = '';
						} else {
							$value = $data->$val;
						}
						array_push($fval, $value);
					}
				}
				$last_dt = $this_dt;
				$last_mass = $this_mass;
				$last_type = $this_type;
				echo implode("\t", $fval) . "\n";
			}

			Yii::app()->end();
			return;
		}

		$this->render('mass-bookings', array(
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

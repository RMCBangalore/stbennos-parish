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
		Yii::trace("POST " . var_export($_POST, true), 'application.controllers.ReportsController');
		$period = $_POST['period'];
		Yii::trace("period = $period", 'application.controllers.ReportsController');
		if (preg_match('/^\d+$/', $period)) {
			$query = function($fld) {
				$yr = $_POST['period'];
				return "$fld BETWEEN '$yr-01-01' AND '$yr-12-31'";
			};
		} else {
			$query = function($fld) {
				return "$fld > NOW() - INTERVAL 1 YEAR";
			};
		}
		$fams = Families::model()->findAll();
		$ppl = People::model()->findAll();
		$baptised1 = BaptismRecord::model()->findAll($query('baptism_dt') . ' AND dob > NOW() - INTERVAL 1 YEAR');
		$baptised7 = BaptismRecord::model()->findAll($query('baptism_dt') . ' AND dob BETWEEN NOW() - INTERVAL 7 YEAR AND NOW() - INTERVAL 1 YEAR');
		$baptised7p = BaptismRecord::model()->findAll($query('baptism_dt') . ' AND dob < NOW() - INTERVAL 7 YEAR');
		$baptised = BaptismRecord::model()->findAll($query('baptism_dt'));
		$confirmed = ConfirmationRecord::model()->findAll($query('confirmation_dt'));
		$firstComm = FirstCommunionRecord::model()->findAll($query('communion_dt'));
		$married = MarriageRecord::model()->findAll($query('marriage_dt'));
		$married_cath = MarriageRecord::model()->findAll($query('marriage_dt') . ' AND marriage_type <= 2');
		$married_nc = MarriageRecord::model()->findAll($query('marriage_dt') . ' AND marriage_type > 2');
		$schedule = MassSchedule::model()->findAll(array(
			'order' => 'day, time'
		));
		$pp = Pastors::model()->find('role = 1');
		$apps = Pastors::model()->findAll('role != 1');

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
			'married_nc'	=> count($married_nc),
			'married_cath'	=> count($married_cath),
			'pp'		=> $pp,
			'apps'		=> $apps,
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

	public function actionIndex()
	{
		$uri = Yii::app()->request->baseUrl . '/css/report-index.css';
		Yii::app()->clientScript->registerCssFile($uri, 'screen, projection');
		$this->render('index');
	}

	public function actionAccountStatement()
	{
		$uri = Yii::app()->request->baseUrl . '/css/account-statement.css';
		Yii::app()->clientScript->registerCssFile($uri, 'screen, projection');

		$model = new Transaction;

		if (isset($_POST['range'])) {
			$range = $_POST['range'];
			if ('custom' == $range) {
				$from_dt = $_POST['from_dt'];
				$to_dt = $_POST['to_dt'];
				$from_dt = date('Y-m-d',
					    CDateTimeParser::parse($from_dt,
					    Yii::app()->locale->getDateFormat('short')));
				$to_dt = date('Y-m-d',
					    CDateTimeParser::parse($to_dt,
					    Yii::app()->locale->getDateFormat('short')));
			} else {
				$subrange = $_POST['subrange'];
				if (preg_match('/^this-/', $subrange)) {
					$to_dt = date('Y-m-d');
				} elseif ('last-month' == $subrange) {
					$to_dt = new DateTime(date('Y-m-') . '01');
					$to_dt->sub(new DateInterval('P1D'));
					$to_dt = date_format($to_dt, 'Y-m-d');
				} elseif ('last-year' == $subrange) {
					$last_yr = date('Y') - 1;
					$to_dt = strval($last_yr) . '-12-31';
				} elseif ('last-fy' == $subrange) {
					$this_yr = date('Y');
					if (date('m') > 3) {
						$to_dt = strval($this_yr) . '-03-31';
						$from_dt = strval($this_yr - 1) . '-04-01';
					} else {
						$to_dt = strval($this_yr - 1) . '-03-31';
						$from_dt = strval($this_yr - 2) . '-04-01';
					}
				}
				if (preg_match('/-month$/', $subrange)) {
					$from_dt = preg_replace('/\d+$/', '01', $to_dt);
				} elseif (preg_match('/-year$/', $subrange)) {
					$from_dt = preg_replace('/[01]\d-\d\d$/', '01-01', $to_dt);
				} elseif ('this-fy' == $subrange) {
					$this_yr = date('Y');
					if (date('m') > 3) {
						$from_dt = strval($this_yr) . '-04-01';
					} else {
						$from_dt = strval($this_yr - 1) . '-04-01';
					}
				} elseif (!isset($from_dt)) {
					$from_dt = new DateTime($to_dt);
					$from_dt->sub(new DateInterval('P1Y'));
					$from_dt->add(new DateInterval('P1D'));
					$from_dt = date_format($from_dt, 'Y-m-d');
				}
				$to_dt .= ' 23:59:59';
			}

			$trans = $model->findAll("created < '$from_dt'");
			$obal = 0;
			foreach($trans as $tr) 
			{
				if ('credit' === $tr->type) {
					$obal += $tr->amount;
				} else {
					$obal -= $tr->amount;
				}
			}
			$data = $model->findAll("created >= '$from_dt' AND created <= '$to_dt'");
			$this->render('accountStatement', array('from_dt' => $_POST['from_dt'], 'to_dt' => $_POST['to_dt'], 'obal' => $obal, 'data' => $data));
			return;
		}

		$this->render('accountStatement', array('model' => $model));
	}

	public function actionAccountSummary()
	{
		$uri = Yii::app()->request->baseUrl . '/css/account-statement.css';
		Yii::app()->clientScript->registerCssFile($uri, 'screen, projection');

		if (isset($_POST['from_dt'])) {
			$from_dt = $_POST['from_dt'];
			$to_dt = $_POST['to_dt'];
			$from_dt = date('Y-m-d',
                                    CDateTimeParser::parse($from_dt,
                                    Yii::app()->locale->getDateFormat('short')));
			$to_dt = date('Y-m-d',
                                    CDateTimeParser::parse($to_dt,
                                    Yii::app()->locale->getDateFormat('short')));

			function processAccounts(&$accounts, $from_dt, $to_dt, $accts, $depth=0) {
				foreach($accts as $acct) {
					$ph = $acct->placeholder;
					$account = array(
						'name' => $acct->name,
						'depth' => $depth,
						'placeholder' => $ph,
					);
					if (!isset($ph)) {
						$trans = Transaction::model()->findAll("created < '$from_dt' and account_id = " . $acct->id);
						$obal = 0;
						foreach($trans as $tr) {
							if ('credit' === $tr->type) {
								$obal += $tr->amount;
							} else {
								$obal -= $tr->amount;
							}
						}
						$trans = Transaction::model()->findAll("created between '$from_dt' and '$to_dt' and account_id = " . $acct->id);
						$cr = $deb = 0;
						foreach($trans as $tr) {
							if ('credit' === $tr->type) {
								$cr += $tr->amount;
							} else {
								$deb += $tr->amount;
							}
						}
						$cbal = $obal + $cr - $deb;
						$account['obal'] = $obal;
						$account['credit'] = $cr;
						$account['debit'] = $deb;
						$account['cbal'] = $cbal;
					}
					array_push($accounts, $account);
					$children = $acct->childAccounts;
					if ($children) {
						processAccounts($accounts, $from_dt, $to_dt, $children, $depth+1);
					}
				}
			};

			$accounts = array();
			$accts = Account::model()->findAll("parent IS NULL");
			processAccounts($accounts, $from_dt, $to_dt, $accts);

			$this->render('accountSummary', array(
				'from_dt' => $_POST['from_dt'],
				'to_dt' => $_POST['to_dt'],
				'accounts' => $accounts));
			return;
		}

		$this->render('accountSummary');
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

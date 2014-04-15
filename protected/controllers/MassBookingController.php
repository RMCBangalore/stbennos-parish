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

class MassBookingController extends RController
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'rights', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	public function actionViewCert($id)
	{
		$this->render('view_cert',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate($for = null, $mass_id = null)
	{
		$model=new MassBooking;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['MassBooking']))
		{
			$tr = Yii::app()->db->beginTransaction();
			$acct = Account::get('Mass Bookings');
			$trans = new Transaction;
			$trans->type = 'credit';
			$trans->account_id = $acct->id;
			$trans->amount = $_POST['amount'];
			$trans->created = Yii::app()->dateFormatter->formatDateTime(time(), 'short', 'medium');
			$trans->creator = Yii::app()->user->id;
			$trans->descr = "Mass booking";
			if ($trans->save()) {
				$model->attributes=$_POST['MassBooking'];
				$model->trans_id = $trans->id;
				if($model->save()) {
					$trans->saveAttributes(array(
						'descr' => "Mass booking #" . $model->id
					));
					$tr->commit();
					$this->redirect(array('view','id'=>$model->id));
					return;
				}
			}
			$tr->rollback();
		}

		$parms = array(
			'model'=>$model,
		);

		$parms['mass_dt'] = isset($for) ? $for : '';
		$parms['mass_id'] = isset($mass_id) ? $mass_id : '';

		$this->render('create', $parms);
	}

	public function getMasses($mass_dt) {
		$dow = date_format($mass_dt, 'w');
		$data = MassSchedule::model()->findAllByAttributes(array(
			'day' => $dow
		), array(
			'order' => 'time'
		));
		return $data;
	}

	public function actionMasses() {
		Yii::trace('massBooking/masses called', 'application.controllers.MassBooking');
		if (isset($_POST['MassBooking'])) {
			$mass_dt = $_POST['MassBooking']['mass_dt'];
			$dt = new DateTime(date('Y-m-d', CDateTimeParser::parse($mass_dt,
					Yii::app()->locale->getDateFormat('short'))));
			$data = $this->getMasses($dt);
			$lv = FieldNames::values('languages');
			echo CHtml::tag('option', array('value' => ''), '--- Select ---', true);
			$today = Yii::app()->dateFormatter->formatDateTime(time(), 'short', null);
			$now = Yii::app()->dateFormatter->formatDateTime(time(), null, 'short');
			if ($dt < new DateTime()) return;
			foreach ($data as $mass) {
				if ($today === $mass_dt and $mass->time < $now) continue;
				echo CHtml::tag('option',
					array('value' => $mass->id), CHtml::encode($mass->time . " -- " . $lv[$mass->language]), true);
			}
		}
	}

	public function isSpecialMass($mass_dt) {
		$dow = date_format($mass_dt, 'w');
		if (0 == $dow) {
			return "Sunday";
		} else {
			$yr = date_format($mass_dt, 'Y');
			$dtEaster = new DateTime();
			$dtEaster->setTimeStamp(easter_date($yr));
			$dtSacredHeart = clone $dtEaster;
			$dtSacredHeart->add(new DateInterval("P68D"));
			$feast_days = array(	# based on http://en.wikipedia.org/wiki/Solemnity#List_and_dates
				"Jan 01" => "Mary, Mother of God",			# does not include solemnities falling on Sunday
				"Jan 06" => "Epiphany",
				"Mar 19" => "St Joseph",
				"Mar 25" => "Annunciation",
				date_format($dtSacredHeart, 'M d') => "Sacred Heart of Jesus",
				"Jun 24" => "Nativity of John the Baptist",
				"Jun 29" => "Sts Peter & Paul",
				"Aug 15" => "Assumption",
				"Nov 01" => "All Saints",
				"Dec 08" => "Immaculate Conception",
				"Dec 25" => "Christmas"
			);
			$dm = date_format($mass_dt, 'M d');
			if (array_key_exists($dm, $feast_days)) {
				return $feast_days[$dm];
			}
		}
		return false;
	}

	public function actionMassAmt() {
		if (isset($_POST['MassBooking'])) {
			$mass_dt = $_POST['MassBooking']['mass_dt'];
			$mass_type = $this->isSpecialMass(
				new DateTime(date('Y-m-d', CDateTimeParser::parse($mass_dt,
					Yii::app()->locale->getDateFormat('short'))))
			);
			$parish = Parish::get();
			$cmt = "";
			if ($mass_type) {
				$amt = $parish->mass_book_sun;
				$cmt = "($mass_type)";
			} else {
				$amt = $parish->mass_book_basic;
			}
			echo "Amount will be: &#8377; $amt $cmt<input name='amount' type='hidden' value='$amt'>";
		}
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['MassBooking']))
		{
			$model->attributes=$_POST['MassBooking'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex($date = null)
	{
		if (isset($date)) {
			$dataProvider=new CActiveDataProvider('MassBooking', array(
				'criteria' => array(
					'condition' => "mass_dt = '$date'",
				)
			));
		} else {
			$dataProvider=new CActiveDataProvider('MassBooking');
		}
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new MassBooking('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['MassBooking']))
			$model->attributes=$_GET['MassBooking'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function actionSearch()
	{
		if (isset($_GET['key'])) {
			$key = $_GET['key'];
			$keys = preg_split('/[\s\+]+/', $key);

			$crit = new CDbCriteria();
			foreach($keys as $key) {
				$crit->mergeWith(array('condition' => "booked_by like '%$key%'"), 'OR');
				$crit->mergeWith(array('condition' => "intention like '%$key%'"), 'OR');
			}
			$ppl = new CActiveDataProvider('MassBooking', array(
				'criteria' => $crit
			));

			if ($ppl->itemCount > 0)
				$this->renderPartial('index', array(
					'dataProvider' => $ppl
				));
		}
	}

	public function actionCalendar()
	{
		$this->render('calendar', array(
		));
	}

	public function getMassBookings($date, $mass) {
		$model = MassBooking::model()->findAllByAttributes(array(
					'mass_dt' => date_format($date, 'Y-m-d'),
					'mass_id' => $mass
				), array(
					'join' => 'INNER JOIN masses m ON m.id = t.mass_id',
					'order' => 'm.time'
				));

		return $model;
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return MassBooking the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=MassBooking::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param MassBooking $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='mass-booking-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}

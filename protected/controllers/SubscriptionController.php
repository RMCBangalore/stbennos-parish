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

class SubscriptionController extends RController
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

	public function actionTillDate($family) {
		if (!preg_match('/(object|Families)/', gettype($family))) {
			$family = Families::model()->findByPk($family);
		}
			$this->renderPartial('_till_month', array(
				'start_dt' => $this->getStartDate($family)));
	}

	public function getStartDate($family) {

			$sub = Subscription::model()->findByAttributes(array(
								'family_id' => $family->id
							), array(
								'order' => 'end_year DESC, end_month DESC'
							));

			Yii::trace("SC.getStartDate called for family #".$family->id."=".gettype($family),
				'application.controllers.SubscriptionController');

			if ($sub) {
				$dt = new DateTime(sprintf("%d-%02d-%d", $sub->end_year, $sub->end_month, 15));
				$dt->add(new DateInterval('P1M'));
				return $dt;
			} else {
				$dt = new DateTime();
				$dt->setTimestamp(CDateTimeParser::parse($family->reg_date, Yii::app()->locale->getDateFormat('short')));
				return $dt;
			}
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate($fid = null)
	{
		$model=new Subscription;
		$parms = array();

		if(isset($_POST['Subscription']) and isset($_POST['Subscription']['family_id'])) {
			$fid = $_POST['Subscription']['family_id'];
		}

		if (isset($fid)) {
			$family = Families::model()->findByPk($fid);
			$parms['family'] = $family;

			$dt = $this->getStartDate($family);
			$parms['start_dt'] = $dt;

			Yii::trace("SC.create: fid:" . $family->id . ", dt=" . date_format($dt, 'Y-m-d'),
				'application.controllers.SubscriptionController');
		}

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Subscription']))
		{
			$till = $_POST['Subscription']['till'];
			$amt = $_POST['Subscription']['amount'];

			$start_dt = new DateTime(date_format($dt, 'Y-m-d'));

			$end_dt = new DateTime(date_format($dt, 'Y-m-d'));
			$end_dt->add(new DateInterval('P'.$till.'M'));

			$tr = Yii::app()->db->beginTransaction();
			$trans = new Transaction;
			$acct = Account::get('Family Subscriptions');
			$trans->account_id = $acct->id;
			$trans->type = 'credit';
			if ('total' == $_POST['duration']) {
				$total = $amt;
				$amt = $amt / $till;
			} else {
				$total = $till * $amt;
			}
			$trans->amount = $total;
			$trans->created = Yii::app()->dateFormatter->formatDateTime(time(), 'short', 'medium');
			$trans->creator = Yii::app()->user->id;
			$trans->descr = "Family #" . $family->id . ' subscription from '
				. date_format($start_dt, 'M Y') . ' to ' . date_format($end_dt, 'M Y');

			if ($trans->save()) {
				$model=new Subscription;

				$model->paid_by = $_POST['Subscription']['paid_by'];
				$model->family_id = $family->id;
				$model->start_month = date_format($start_dt, 'n');
				$model->start_year = date_format($start_dt, 'Y');
				$model->end_month = date_format($end_dt, 'n');
				$model->end_year = date_format($end_dt, 'Y');
				$model->amount = $amt;
				$model->trans_id = $trans->id;

				if($model->save()) {
					$tr->commit();
					$this->redirect(array('view','id'=>$model->id));
					return;
				}
			}
			$tr->rollback();
		}

		$parms['model'] = $model;
		$this->render('create', $parms);
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

		if(isset($_POST['Subscription']))
		{
			$model->attributes=$_POST['Subscription'];
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
	public function actionIndex($fid = null)
	{
		$parms = array();

		if (isset($fid)) {
			$family = Families::model()->findByPk($fid);
			$parms['family'] = $family;

			$crit = array(
				'condition' => "family_id = $fid",
				'order' => 'end_year ASC, end_month ASC'
			);
		} else {
			$crit = array(
				'order' => 'end_year ASC, end_month ASC'
			);
		}

		$dataProvider = new CActiveDataProvider('Subscription', array(
							'criteria' => $crit
						));

		$parms['dataProvider'] = $dataProvider;

		$this->render('index', $parms);
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin($fid = null)
	{
		$model=new Subscription('search');
		$model->unsetAttributes();  // clear any default values

		if (isset($fid)) {
			$family = Families::model()->findByPk($fid);

			$model->family_id = $family->id;
		}

		if(isset($_GET['Subscription']))
			$model->attributes=$_GET['Subscription'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function actionViewRect($id) {
		$this->render('view_cert', array(
			'model' => $this->loadModel($id)
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Subscription the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Subscription::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Subscription $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='subscription-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}

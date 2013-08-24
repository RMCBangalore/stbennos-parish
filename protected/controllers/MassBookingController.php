<?php

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
			$trans = new Transaction;
			$trans->type = 'credit';
			$trans->amount = Yii::app()->params['massBookAmt'];
			$trans->created = date_format(new DateTime(), 'Y-m-d H:i:s');
			$trans->creator = Yii::app()->user->id;
			$trans->descr = "Mass booking";
			if ($trans->save()) {
				$model->attributes=$_POST['MassBooking'];
				$model->trans_id = $trans->id;
				if($model->save()) {
					$trans->descr = "Mass booking #" . $model->id;
					$trans->save(false);
					$this->redirect(array('view','id'=>$model->id));
				}
			}
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
			$data = $this->getMasses(new DateTime($mass_dt));
			$lv = FieldNames::values('languages');
			echo CHtml::tag('option', array('value' => ''), '--- Select ---', true);
			foreach ($data as $mass) {
				echo CHtml::tag('option',
					array('value' => $mass->id), CHtml::encode($mass->time . " -- " . $lv[$mass->language]), true);
			}
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
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('MassBooking');
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

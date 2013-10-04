<?php

class BannsRecordsController extends RController
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

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new BannsRecord;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['BannsRecord'])) {
			$model->attributes=$_POST['BannsRecord'];
			if($model->save()) {
				if (Yii::app()->getUser()->hasState('local')) {
					Yii::app()->getUser()->setState('local', null);
				}
				$this->redirect(array('view','id'=>$model->id));
			}
		} elseif (isset($_GET['local'])) {
			$local = $_GET['local'];
			if (!Yii::app()->getUser()->hasState('local')) {
				Yii::trace('Setting session var local', 'application.controllers.BannsRecordsController');
				Yii::app()->getUser()->setState('local', $local);
			}
			$sex = ('bride' == $local) ? 2 : 1;
			if (isset($_POST['member'])) {
				$mid = $_POST['member'];
				Yii::trace("Got member $mid", 'application.controllers.BannsRecordsController');
				if ('both' == Yii::app()->getUser()->getState('local')) {
					if ('both' == $local) {
						Yii::app()->getUser()->setState('groom', $mid);
						Yii::trace("local = $local. Going to redirect", 'application.controllers.BannsRecordsController');
						$this->redirect(array('create', 'local' => 'bride'));
					} else {
						$gid = Yii::app()->getUser()->getState('groom');
						$groom = People::model()->findByPk($gid);
						$bride = People::model()->findByPk($mid);
						$this->render('create',array(
							'model'	=> $model,
							'local'	=> 'both',
							'groom' => $groom,
							'bride' => $bride,
						));
					}
				} else {
					$member = People::model()->findByPk($mid);
					$this->render('create',array(
						'model'=>$model,
						'local'=>$local,
						$local=>$member,
					));
				}
			} else {
				$members = new CActiveDataProvider('People', array(
					'criteria' => array(
						'condition' => "sex = $sex and role != 'husband' and role != 'wife'"
					)
				));
				$this->render('create',array(
					'model'=>$model,
					'members'=>$members,
				));
			}
			return;
		} else {
			Yii::app()->getUser()->setState('local', null);
		}

		$this->render('create',array(
			'model'=>$model,
		));
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

		if(isset($_POST['BannsRecord']))
		{
			$model->attributes=$_POST['BannsRecord'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		if (ctype_digit($model->groom_parish)) {
			if (ctype_digit($model->bride_parish)) {
				$local = 'both';
			} else {
				$local = 'groom';
			}
		} elseif (ctype_digit($model->bride_parish)) {
			$local = 'bride';
		}

		$this->render('update',array(
			'model'=>$model,
			'local'=>$local,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		try {
			$this->loadModel($id)->delete();
		}

		catch (CDbException $e) {
			if (preg_match('/Cannot\ delete\ or\ update\ a\ parent\ row:\ a\ foreign\ key\ constraint\ 
					 fails.*banns_id/x', $e->getMessage(), $matches)) {
				throw new CHttpException(412, "Cannot delete because one or more letters are linked to this record");
			} else {
				throw $e;
			}
		}

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('BannsRecord');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new BannsRecord('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['BannsRecord']))
			$model->attributes=$_GET['BannsRecord'];

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
				$crit->mergeWith(array('condition' => "groom_name like '%$key%'"), 'OR');
				$crit->mergeWith(array('condition' => "bride_name like '%$key%'"), 'OR');
			}
			$ppl = new CActiveDataProvider('BannsRecord', array(
				'criteria' => $crit
			));

			if ($ppl->itemCount > 0)
				$this->renderPartial('index', array(
					'dataProvider' => $ppl
				));
		}
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return BannsRecord the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=BannsRecord::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param BannsRecord $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='banns-record-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}

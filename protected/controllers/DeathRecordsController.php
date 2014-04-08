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

class DeathRecordsController extends RController
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
		$uri = Yii::app()->request->baseUrl . '/css/register-view.css';
		Yii::app()->clientScript->registerCssFile($uri, 'screen, projection');
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
		$model=new DeathRecord;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['DeathRecord']))
		{
			$model->attributes=$_POST['DeathRecord'];
			if($model->save()) {
				if ($model->member_id) {
					if (!isset($model->member->death_dt)) {
						$member = $model->member;
						$member->death_dt = $model->death_dt;
						if (!$member->save(true, array('death_dt'))) {
							Yii::trace(sprintf('Error saving member %d death_dt: %s', $member->id, implode(', ', $member->getErrors('death_dt'))), 'application.controllers.DeathRecord');
						}
					}
				}
				$this->redirect(array('view','id'=>$model->id));
			}
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

		if(isset($_POST['DeathRecord']))
		{
			$model->attributes=$_POST['DeathRecord'];
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
		try {
			$this->loadModel($id)->delete();
		}

		catch (CDbException $e) {
			if (preg_match('/Cannot\ delete\ or\ update\ a\ parent\ row:\ a\ foreign\ key\ constraint\ 
					 fails.*death_certs/x', $e->getMessage(), $matches)) {
				throw new CHttpException(412, "Cannot delete because one or more death certificates refer to this record");
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
		$uri = Yii::app()->request->baseUrl . '/css/register-index.css';
		Yii::app()->clientScript->registerCssFile($uri, 'screen, projection');
		$dataProvider=new CActiveDataProvider('DeathRecord');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new DeathRecord('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['DeathRecord']))
			$model->attributes=$_GET['DeathRecord'];

		if(isset($_GET['export'])) {
			header( "Content-Type: application/vnd.ms-excel; charset=utf-8" );
			header( "Content-Disposition: inline; filename=\"deaths-report.xls\"" );

			$dataProvider = $model->search();
			$dataProvider->pagination = false;

			$fields = array(
					'id',
					'fname',
					'lname',
					'death_dt',
					'cause',
					'age',
					'profession',
					'buried_dt',
					'minister',
					'burial_place',
					'ref_no',
					'residence',
					'community',
					'parents_relatives',
					'sacrament',
					'member_id',
				);

			$labels = $model->attributeLabels();
			$fval = array();

			foreach($fields as $field) {
				array_push($fval, $labels[$field]);
			}
			echo implode("\t", $fval) . "\n";

			foreach($dataProvider->data as $data) {
				$fval = array();
				foreach($fields as $field) {
					$val = $data->$field;
					array_push($fval, $val);
				}
				echo implode("\t", $fval) . "\n";
			}

			Yii::app()->end();
		}

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
				$crit->mergeWith(array('condition' => "fname like '%$key%'"), 'OR');
				$crit->mergeWith(array('condition' => "lname like '%$key%'"), 'OR');
			}
			$ppl = new CActiveDataProvider('DeathRecord', array(
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
	 * @return DeathRecord the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=DeathRecord::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param DeathRecord $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='death-record-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}

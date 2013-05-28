<?php

class FamilyController extends RController
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
			'rights',
/*			'rights', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
*/		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
/*			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','children', 'survey'),
				'users'=>array('@'),
			),
*/			array('allow', // allow admin user to perform 'admin' and 'delete' actions
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
	public function actionCreate($id = null, $step = 0)
	{
		Yii::trace("FC.actionCreate called", 'application.controllers.FamilyController');
		if (!isset($id) and $_POST and isset($_POST['Families']) and isset($_POST['Families']['id'])) {
			$id = $_POST['Families']['id'];
		}
		$model = isset($id) ? $this->loadModel($id) : new Families;
		$cur_model = $model;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		switch ($step) {
		case 1:
//			$this->performAjaxValidation($model);
			if (isset($_POST['Families'])) {
				$model->attributes=$_POST['Families'];
				if ($model->save()) {
					++$step;
				}
			}
			break;
		case 2: 
			$person = 'husband';
		case 3:
			if (!isset($person)) {
				$person = 'wife';
			}
			$p = new People();
			$cur_model = $p;
			$this->performAjaxValidation($p);
			if(isset($_POST['People'][$person])) {
				$p->attributes = $_POST['People'][$person];
				$p->family_id = $model->id;
				$p->role = $person;
				if ($p->save()) {
					++$step;
					switch ($person) {
						case 'husband': $model->husband_id = $p->id;
							break;
						case 'wife': $model->wife_id = $p->id;
							break;
					}
					$model->save(false);
				}
			}
			break;
		case 4:
		case 5:
			$i = $step - 4;
			if (isset($_POST['People']['dependent'])) {
				if (isset($_POST['People']['dependent'][$i])) {
					$p = new People();
					$cur_model = $p;
					$p->attributes = $_POST['People']['dependent'][$i];
					$p->family_id = $model->id;
					$p->role = 'dependent';
					if ($p->save()) {
						++$step;
					}
				}
			}
			break;
		case 6:
		case 7:
		case 8:
			$i = $step - 6;
			if (isset($_POST['People']['child'])) {
				if (isset($_POST['People']['child'][$i])) {
					$p = new People();
					$cur_model = $p;
					$p->attributes = $_POST['People']['child'][$i];
					$p->family_id = $model->id;
					$p->role = 'child';
					if ($p->save()) {
						++$step;
					}
				}
			}
			break;
		default:
			if (++$step > 8 and isset($model->id)) {
				$this->redirect(array('view','id'=>$model->id));
			}
		}

		Yii::trace("FC.actionCreate rendering", 'application.controllers.FamilyController');
		$this->render('create',array(
			'model'=>$model,
			'step'=>$step,
			'cur_model'=>$cur_model,
		));
		Yii::trace("FC.actionCreate exiting", 'application.controllers.FamilyController');
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

		if(isset($_POST['Families']))
		{
			$model->attributes=$_POST['Families'];
			if($model->save()) {
#				$this->redirect(array('view','id'=>$model->id));
				$save_it = false;
				foreach(array('husband', 'wife') as $person) {
					if(isset($_POST['People'][$person])) {
						$p = new People();
#						$pid = $_POST['People'][$person]['id'];
						if ($pid = $_POST['People'][$person]['id']) {
							$p = People::model()->findByPk($pid);
						}
						$p->attributes = $_POST['People'][$person];
						$p->family_id = $model->id;
						$p->role = $person;
						if ($p->save()) {
							switch ($person) {
								case 'husband': if (!isset($model->husband_id)) {
									$model->husband_id = $p->id;
									$save_it = true;
								}
								break;
								case 'wife': if (!isset($model->wife_id)) {
									$model->wife_id = $p->id;
									$save_it = true;
								}
								break;
							}
						}
					}
				}
				if ($save_it) {
					$model->save();
				}

				if (isset($_POST['People']['dependent'])) {
					for($i = 0; $i < 2; ++$i) {
						if (isset($_POST['People']['dependent'][$i])) {
							$p = new People();
							if ($pid = $_POST['People']['dependent'][$i]['id']) {
								$p = People::model()->findByPk($pid);
							}
							$p->attributes = $_POST['People']['dependent'][$i];
							$p->family_id = $model->id;
							$p->role = 'dependent';
							$p->save();
						}
					}
				}
				if (isset($_POST['People']['child'])) {
					for($i = 0; $i < 4; ++$i) {
						if (isset($_POST['People']['child'][$i])) {
							$p = new People();
							if ($pid = $_POST['People']['child'][$i]['id']) {
								$p = People::model()->findByPk($pid);
							}
							$p->attributes = $_POST['People']['child'][$i];
							$p->family_id = $model->id;
							$p->role = 'child';
							$p->save();
						}
					}
				}
			}
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	public function actionChildren($id) {
		$model = $this->loadModel($id);
		
		if (isset($_POST['People']['child'])) {
			for($i = 0; $i < 10; ++$i) {
				if (isset($_POST['People']['child'][$i])) {
					if ($pid = $_POST['People']['child'][$i]['id']) {
						$p = People::model()->findByPk($pid);
					} else {
						$p = new People();
					}
					$p->attributes = $_POST['People']['child'][$i];
					$p->family_id = $model->id;
					$p->role = 'child';
					$p->save();
				}
			}
		}

		$this->render('children',array(
			'model'=>$model,
		));
	}

	public function actionSurvey($id) {
		$model = $this->loadModel($id);

		if (isset($_POST['SatisfactionData'])) {
			foreach($_POST['SatisfactionData'] as $sid => $value) {
				$sd = SatisfactionData::model()->findByAttributes(array(
					'family_id' => $id,
					'satisfaction_item_id' => $sid
				));
				if (!$sd) {
					$sd = new SatisfactionData();
				}
				$sd->attributes = $value;
				$sd->family_id = $id;
				$sd->satisfaction_item_id = $sid;
				$sd->save();
			}
		}

		if (isset($_POST['NeedData'])) {
			foreach($_POST['NeedData'] as $nid => $value) {
				$nd = NeedData::model()->findByAttributes(array(
					'family_id' => $id,
					'need_id' => $nid
				));
				if (!$nd) {
					$nd = new NeedData();
				}
				$nd->attributes = $value;
				$nd->family_id = $id;
				$nd->need_id = $nid;
				$nd->save();
			}
		}

		if (isset($_POST['AwarenessData'])) {
			foreach($_POST['AwarenessData'] as $aid => $value) {
				$ad = AwarenessData::model()->findByAttributes(array(
					'family_id' => $id,
					'awareness_id' => $aid
				));
				if (!$ad) {
					$ad = new AwarenessData();
				}
				$ad->attributes = $value;
				$ad->family_id = $id;
				$ad->awareness_id = $aid;
				$ad->save();
			}
		}

		if (isset($_POST['OpenData'])) {
			foreach($_POST['OpenData'] as $qid => $value) {
				$od = OpenData::model()->findByAttributes(array(
					'family_id' => $id,
					'question_id' => $qid
				));
				if (!$od) {
					$od = new OpenData();
				}
				$od->attributes = $value;
				$od->family_id = $id;
				$od->question_id = $qid;
				$od->save();
			}
		}

		$satisfactionItems = SatisfactionItem::model()->findAll();
		$needItems = NeedItem::model()->findAll();
		$openQuestions = OpenQuestion::model()->findAll(array('order' => 'seq'));
		$awarenessItems = NeedItem::model()->findAll();

		$this->render('survey', array(
			'model' => $model,
			'satisfactionItems' => $satisfactionItems,
			'satisfactionData' => Families::satisfactionData($id),
			'needItems' => $needItems,
			'needData' => Families::needData($id),
			'awarenessItems' => $awarenessItems,
			'awarenessData' => Families::awarenessData($id),
			'openQuestions' => $openQuestions,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$model = $this->loadModel($id);
		$model->husband_id = null;
		$model->wife_id = null;
		$model->save();
		$model->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Families');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Families('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Families']))
			$model->attributes=$_GET['Families'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Families the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Families::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Families $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		Yii::trace("FC.performAjaxValidation called for " . gettype($model), 'application.controllers.FamilyController');
		if(isset($_POST['ajax']) && $_POST['ajax']==='families-form')
		{
			echo CActiveForm::validate($model);
			Yii::trace("FC.performAjaxValidation done for " . gettype($model), 'application.controllers.FamilyController');
			Yii::app()->end();
		}
	}
}

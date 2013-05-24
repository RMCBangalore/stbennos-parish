<?php

class PersonController extends RController
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
/*			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
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
	public function actionCreate()
	{
		$model=new People;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['People']))
		{
			$model->attributes=$_POST['People'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
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

		if(isset($_POST['People']))
		{
			$model->attributes=$_POST['People'];
/*			foreach($_FILES as $key => $value) {
				foreach($value as $vkey => $vval) {
					foreach ($vval as $vk => $vv) {
						Yii::trace("Photo \$_FILES[$key][$vkey][$vk] isa " . gettype($vv), "system.controllers.RController");
					}
				}
			} */
			$files = $_FILES['People']; # has keys name, type, size, error, tmp_name
			if (isset($files['name']['photo'])) {
				if (isset($files['tmp_name']['photo'])) {
					$dir = "./images/members/";
					if (!file_exists($dir)) {
						mkdir($dir, 0755, true);
					}
					$filename = $files['name']['photo'];
					$fname = preg_replace('/\.[a-z]+$/i', '', $filename);
					preg_match('/(\.[a-z]+)$/i', $filename, $matches);
					$fext = $matches[0];
					Yii::trace("Filename $filename = $fname  + $fext", 'system.controllers.RController');
					if (file_exists($dir . $filename)) {
						$fname .= "_01";
						while (file_exists($dir . $fname . $fext)) {
							++$fname;
						}
					}
					$dest = $dir . $fname . $fext;
					$tmp_path = $files['tmp_name']['photo'];
					$dim = getimagesize($tmp_path);
					$width = $dim[0];
					$height = $dim[1];
					if ($width > 160 or $height > 200) {
						Yii::trace("Image bigger than 160x200 (${width}x$height)", "system.controllers.RController");
					} else {
						move_uploaded_file($tmp_path, $dest);
						$model->photo = $fname . $fext;
						Yii::trace("Got photo. Moved to $dest", 'system.controllers.RController');
					}
				} else {
					Yii::trace("Failed to upload photo: " . $files['error']['photo'], 'system.controllers.RController');
				}
			}
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
		$dataProvider=new CActiveDataProvider('People');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	public function actionBaptised()
	{
		$dataProvider=new CActiveDataProvider('People', array(
			'criteria' => array(
				'condition' => 'baptism_dt is not null'
			),
		));
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	public function actionConfirmed()
	{
		$dataProvider=new CActiveDataProvider('People', array(
			'criteria' => array(
				'condition' => 'confirmation_dt is not null'
			),
		));
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	public function actionMarried()
	{
		$dataProvider=new CActiveDataProvider('People', array(
			'criteria' => array(
				'condition' => 'marriage_dt is not null'
			),
		));
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new People('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['People']))
			$model->attributes=$_GET['People'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return People the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=People::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param People $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='people-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}

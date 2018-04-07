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
		$uri = Yii::app()->request->baseUrl . '/css/person-view.css';
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
		$model=new People;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['People']))
		{
			$model->attributes=$_POST['People'];
			if($model->save()) {
				$model->mid = $model->get_mid();
				$model->save();
				$this->redirect(array('view','id'=>$model->id));
			}
		}

		$ac = People::getAutoCompleteFields();
		$this->render('create', array('model' => $model, 'ac' => $ac));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		$model->scenario = 'update';

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['People']))
		{
			$model->attributes=$_POST['People'];
			if (!isset($model->mid)) {
				$model->mid = $model->get_mid();
			}
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$ac = People::getAutoCompleteFields();
		$this->render('update', array('model' => $model, 'ac' => $ac));
	}

	public function actionPhoto($id) {
		$model = $this->loadModel($id);
		$model->scenario = 'photo';

		if (Yii::app()->params['photoManip']) {
			if (isset($_POST['x1'])) { # cropping
				$x1 = $_POST['x1'];
				$y1 = $_POST['y1'];
				$width = $_POST['width'];
				$height = $_POST['height'];
				$pfile = $_POST['pfile'];
				$sdir = './images/uploaded/';
				list($w, $h, $t) = getimagesize($sdir . $pfile);
				Yii::trace("PC.actionPhoto crop received $x1, $y1, $width, $height, $w, $h, $t", 'application.controllers.PersonController');
				switch ($t) {
				case 1: $img = imagecreatefromgif($sdir . $pfile); break;
				case 2: $img = imagecreatefromjpeg($sdir . $pfile); break;
				case 3: $img = imagecreatefrompng($sdir . $pfile); break;
				case IMAGETYPE_BMP: $img = ImageHelper::ImageCreateFromBMP($sdir . $pfile); break;
				case IMAGETYPE_WBMP: $img = imagecreatefromwbmp($sdir . $pfile); break;
				default: Yii::trace("PC.actionPhoto crop unknown image type $t", 'application.controllers.PersonController');
				}
				if (function_exists('imagecrop')) { # untested
					$cropped = imagecrop($img, array('x1' => $x1, 'y1' => $y1, 'x' => $x1, 'y' => $y1, 'width' => $width, 'height' => $height));
					$scaled = imagescale($cropped, 200);
				} else {
					$h = $height * 200 / $width;
					$scaled = imagecreatetruecolor(200, $h);
					imagecopyresampled($scaled, $img, 0, 0, $x1, $y1, 200, $h, $width, $height);
				}
				$dir = './images/members/';
				$fname = preg_replace('/\.[a-z]+$/i', '', $pfile);
				$fext = ".jpg";
				if (file_exists($dir . $pfile)) {
					$fname .= "_01";
					while (file_exists($dir. $fname . $fext)) {
						++$fname;
					}
				}
				$dest = $dir . $fname . $fext;
				imagejpeg($scaled, $dest, 90);
				imagedestroy($scaled);
				imagedestroy($img);
				unlink($sdir . $pfile); 
				$model->photo = $fname . $fext;
				$model->save(false);
				Yii::trace("PC.actionPhoto saved to $pfile", 'application.controllers.PersonController');
				$this->redirect(array('view', 'id' => $model->id));
				return;
			} elseif (isset($_FILES['People'])) { # uploading
				Yii::trace("PC.actionPhoto _FILES[People] set", 'application.controllers.PersonController');
				$files = $_FILES['People'];
				$filename = $files['name']['raw_photo'];
				if (isset($filename) and '' != $filename) {
					Yii::trace("PC.actionPhoto filename $filename", 'application.controllers.PersonController');
					$tmp_path = $files['tmp_name']['raw_photo'];
					if (isset($tmp_path) and '' != $tmp_path) {
						Yii::trace("PC.actionPhoto tmp_path $tmp_path", 'application.controllers.PersonController');
						$dir = "./images/uploaded/";
						$dest = $dir . $filename;
						list($width, $height) = getimagesize($tmp_path);
						if ($width < 900) {
							$w = $width;
							$h = $height;
							$zoom = 1;
						} else {
							$w = 900;
							$h = $height * 900 / $width;
							$zoom = $w / $width;
						}
						$w = ($width < 900) ? $width : 900;
						
						move_uploaded_file($tmp_path, $dest);
						$this->render('crop', array('model'=>$model,'pfile'=>$filename, 'width' => $w, 'height' => $h, 'zoom' => $zoom));
						return;
					} else {
						$errors = array(
							1 => "Size exceeds max_upload",
							2 => "FORM_SIZE",
							3 => "No tmp dir",
							4 => "can't write",
							5 => "error extension",
							6 => "error partial",
						);
						$error = $errors[$files['error']['raw_photo']];
						Yii::trace("PC.actionPhoto file error $error", 'application.controllers.PersonController');
					}
				}
			}
		} elseif (isset($_FILES['People'])) { # Direct upload - no photomanip PHP module
			$files = $_FILES['People']; # has keys name, type, size, error, tmp_name
			$filename = $files['name']['photo'];
			if (isset($filename) and '' != $filename) {
				Yii::trace("Got image " . $filename, 'application.controllers.PersonController');
				$tmp_path = $files['tmp_name']['photo'];
				if (isset($tmp_path) and '' != $tmp_path) {
					Yii::trace("Image temp path: $tmp_path", 'application.controllers.PersonController');
					$dir = "./images/members/";
					$fname = preg_replace('/\.[a-z]+$/i', '', $filename);
					preg_match('/(\.[a-z]+)$/i', $filename, $matches);
					$fext = $matches[0];
					Yii::trace("Filename $filename = $fname  + $fext", 'application.controllers.PersonController');
					if (file_exists($dir . $filename)) {
						$fname .= "_01";
						while (file_exists($dir . $fname . $fext)) {
							++$fname;
						}
					}
					$dest = $dir . $fname . $fext;
					$model->photo = $fname . $fext;
					if ($model->save()) {
						move_uploaded_file($tmp_path, $dest);
						Yii::trace("Got photo. Moved to $dest", 'application.controllers.PersonController');
						$this->redirect(array('view', 'id' => $model->id));
						return;
					}
				} else {
					$model->addError('photo', $files['error']['photo']);
				}
			}
		}

		$this->render('photo', array(
			'model' => $model,
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
		$uri = Yii::app()->request->baseUrl . '/css/person-view.css';
		Yii::app()->clientScript->registerCssFile($uri, 'screen, projection');
		$dataProvider=new CActiveDataProvider('People');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	public function actionSearch()
	{
		if (isset($_GET['key'])) {
			$key = $_GET['key'];
			$keys = preg_split('/\s+/', $key);

			$crit = new CDbCriteria();
			foreach($keys as $key) {
				$crit->mergeWith(array('condition' => "fname like '%$key%'"), 'OR');
				$crit->mergeWith(array('condition' => "lname like '%$key%'"), 'OR');
				if (preg_match('/^\d+-\d+-\d+$/', $key)) {
					list($Y, $m, $d) = explode("-", $key);
					$dob = sprintf("%d-%02d-%02d", $Y, $m, $d);
					$crit->mergeWith(array('condition' => "dob = '$dob'"), 'OR');
				}
			}
			$ppl = new CActiveDataProvider('People', array(
				'criteria' => $crit
			));

			if ($ppl->itemCount > 0)
				$this->renderPartial('index', array(
					'dataProvider' => $ppl
				));
		}
	}

	public function actionBaptised()
	{
		$uri = Yii::app()->request->baseUrl . '/css/person-view.css';
		Yii::app()->clientScript->registerCssFile($uri, 'screen, projection');
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
		$uri = Yii::app()->request->baseUrl . '/css/person-view.css';
		Yii::app()->clientScript->registerCssFile($uri, 'screen, projection');
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
		$uri = Yii::app()->request->baseUrl . '/css/person-view.css';
		Yii::app()->clientScript->registerCssFile($uri, 'screen, projection');
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

		if( isset( $_GET[ 'export' ] ) )
		{
			header( "Content-Type: application/vnd.ms-excel; charset=utf-8" );
			header( "Content-Disposition: inline; filename=\"people-report.xls\"" );

			$dataProvider = $model->search();
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
		}

		$ac = People::getAutoCompleteFields();
		$this->render('admin',array(
			'model'	=>$model,
			'ac'	=>$ac,
		));
	}

	public function actionFindMatch()
	{
		if (Yii::app()->request->isPostRequest) {
			Yii::trace("PC.findMatch POST request", 'application.controllers.PersonController');
			foreach($_POST as $k => $v) {
				Yii::trace("PC.findMach $k: $v", 'application.controllers.PersonController');
			}
			$model = People::model()->findByPk($_POST['person']);
			$person = array(
				'id' => $model->id,
				'fname' => $model->fname,
				'lname' => $model->lname,
				'name' => $model->fullname(),
				'dob' => $model->dob,
				'sex' => $model->sex,
				'baptism_dt' => $model->baptism_dt,
				'baptism_place' => $model->baptism_place,
				'god_parents' => $model->god_parents,
			);
			$fam = $model->family;
			if ('child' === $model->role) {
				if (isset($fam->husband_id)) {
					$person['fathers_name'] = $fam->husband->fullname();
				}
				if (isset($fam->wife_id)) {
					$person['mothers_name'] = $fam->wife->fullname();
				}
				$person['parents_name'] = $model->getParent()->fullname();
			}
			if (isset($model->profession)) {
				$person['rank_prof'] = $model->profession;
			} elseif (isset($model->occupation)) {
				$person['rank_prof'] = $model->occupation;
			}
			echo CJSON::encode($person);
			return;
		}
		$cond = "";
		if (isset($_GET['key'])) {
			$key = $_GET['key'];
			$cond = "fname like '%$key%' or lname like '%$key%' or mid = '$key'";
		}
		if (isset($_GET['sex'])) {
			$sex = 'male' == $_GET['sex'] ? 1 : 2;
			$second = "sex = $sex and role != 'husband' and role != 'wife'";
			if (0 != strlen($cond)) {
				$cond = "($cond) and $second";
			} else {
				$cond = $second;
			}
		}
		$members = new CActiveDataProvider('People', array(
			'criteria' => array(
				'condition' => $cond
			)
		));

		$this->renderPartial('find_match', array(
			'members' => $members
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

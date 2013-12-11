<?php
#
# This file is part of St. Benno's Parish Software
#
# St. Benno's Parish Software - software to manage tomorrow's parish
# Copyright (C) 2013  Redemptorist Media Center
#
# St. Benno's Parish Software is free software: you can redistribute it
# and/or modify it under the terms of the GNU General Public License as
# published by the Free Software Foundation, either version 3 of the
# License, or (at your option) any later version.
#
# St. Benno's Parish Software is distributed in the hope that it will
# be useful, but WITHOUT ANY WARRANTY; without even the implied warranty
# of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
#
# You should have received a copy of the GNU General Public License
# along with this program.  If not, see <http://www.gnu.org/licenses/>.
#

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
		$uri = Yii::app()->request->baseUrl . '/css/family-view.css';
		Yii::app()->clientScript->registerCssFile($uri, 'screen, projection');
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	public function actionLocate($id)
	{
		$model = $this->loadModel($id);

		if (isset($_POST['Families'])) {
			$gmurl = $_POST['Families']['gmap_url'];
			$gmurl = preg_replace('/&/', '&amp;', $gmurl);
			$gmurl .= "&amp;output=embed";
			$model->gmap_url = $gmurl;
			if ($model->save()) {
				$this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->render('locate',array(
			'model'=>$model,
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
			$this->performAjaxValidation($model);
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
					$p->mid = $p->get_mid();
					$p->save(false);
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
					$this->performAjaxValidation($p);
					$p->family_id = $model->id;
					$p->role = 'dependent';
					if ($p->save()) {
						$p->mid = $p->get_mid();
						$p->save(false);
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
					$this->performAjaxValidation($p);
					$p->family_id = $model->id;
					$p->role = 'child';
					if ($p->save()) {
						$p->mid = $p->get_mid();
						$p->save(false);
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

	public function actionDisable($id) {
		$model=$this->loadModel($id);
		$model->disabled = 1;
		$model->leaving_date = date_format(new DateTime(), 'Y-m-d');
		if ($model->save(false)) {
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
	}

	public function actionEnable($id) {
		$model=$this->loadModel($id);
		$model->disabled = 0;
		$model->leaving_date = null;
		if ($model->save(false)) {
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
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
		$model->scenario = 'update';

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		if(isset($_POST['Families']))
		{
			$model->attributes=$_POST['Families'];
			$models = array($model);
			$parents = array();
			foreach(array('husband', 'wife') as $person) {
				if(isset($_POST['People'][$person])) {
					$p = new People();
#						$pid = $_POST['People'][$person]['id'];
					if ($pid = $_POST['People'][$person]['id']) {
						$p = People::model()->findByPk($pid);
					}
					$p->attributes = $_POST['People'][$person];
					$p->role = $person;
					$parents[$person] = $p;
					array_push($models, $p);
				}
			}

			$dependents = array();
			if (isset($_POST['People']['dependent'])) {
				for($i = 0; $i < 2; ++$i) {
					if (isset($_POST['People']['dependent'][$i])) {
						$p = new People();
						if ($pid = $_POST['People']['dependent'][$i]['id']) {
							$p = People::model()->findByPk($pid);
						}
						$p->attributes = $_POST['People']['dependent'][$i];
						$p->role = 'dependent';
						$dependents[$i] = $p;
					}
				}
			}

			$children = array();
			if (isset($_POST['People']['child'])) {
				for($i = 0; $i < 4; ++$i) {
					if (isset($_POST['People']['child'][$i])) {
						$p = new People();
						if ($pid = $_POST['People']['child'][$i]['id']) {
							$p = People::model()->findByPk($pid);
						}
						$p->attributes = $_POST['People']['child'][$i];
						$p->role = 'child';
						$children[$i] = $p;
					}
				}
			}

			$models = array_merge($models, $dependents);
			$models = array_merge($models, $children);

			$this->performAjaxValidation($models);

			if ($model->save()) {
				$save_it = false;

				foreach($parents as $parent) {
					$parent->family_id = $model->id;
					$parent->save();
					if (!isset($parent->mid)) {
						$parent->mid = $parent->get_mid();
						$parent->save(false);
					}
					switch ($parent->role) {
						case 'husband': if (!isset($model->husband_id)) {
							$model->husband_id = $parent->id;
							$save_it = true;
						}
						break;
						case 'wife': if (!isset($model->wife_id)) {
							$model->wife_id = $parent->id;
							$save_it = true;
						}
						break;
					}
				}
				if ($save_it) {
					$model->save(false);
				}
				foreach($dependents as $dependent) {
					$dependent->family_id = $model->id;
					$dependent->save();
					if (!isset($dependent->mid)) {
						$dependent->mid = $dependent->get_mid();
						$dependent->save(false);
					}
				}
				foreach($children as $child) {
					$child->family_id = $model->id;
					$child->save();
					if (!isset($child->mid)) {
						$child->mid = $child->get_mid();
						$child->save(false);
					}
				}
			}
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	public function actionPhoto($id) {
		$model = $this->loadModel($id);
		$model->scenario = 'photo';
		Yii::trace("FC.actionPhoto called", 'application.controllers.FamilyController');

		if (Yii::app()->params['photoManip']) {
			if (isset($_POST['x1'])) {
				$x1 = $_POST['x1'];
				$y1 = $_POST['y1'];
				$width = $_POST['width'];
				$height = $_POST['height'];
				$pfile = $_POST['pfile'];
				$sdir = './images/uploaded/';
				$size = getimagesize($sdir . $pfile);
				if ($size) {
					list($w, $h, $t) = $size;
				} else {
					Yii::trace("FR.actionPhoto crop call to getimagesize failed for image " . $sdir . $pfile . " returned $size", 'application.controllers.FamilyController');
				}
				Yii::trace("FC.actionPhoto crop received $x1, $y1, $width, $height, $w, $h, $t", 'application.controllers.FamilyController');
				switch ($t) {
				case 1: $img = imagecreatefromgif($sdir . $pfile); break;
				case 2: $img = imagecreatefromjpeg($sdir . $pfile); break;
				case 3: $img = imagecreatefrompng($sdir . $pfile); break;
				case IMAGETYPE_BMP: $img = ImageHelper::ImageCreateFromBMP($sdir . $pfile); break;
				case IMAGETYPE_WBMP: $img = imagecreatefromwbmp($sdir . $pfile); break;
				default: Yii::trace("FC.actionPhoto crop unknown image type $t", 'application.controllers.FamilyController');
				}
				if (function_exists('imagecrop')) { # untested
					$cropped = imagecrop($img, array('x1' => $x1, 'y1' => $y1, 'width' => $width, 'height' => $height));
					$scaled = imagescale($cropped, 400);
				} else {
					$h = $height * 400 / $width;
					$scaled = imagecreatetruecolor(400, $h);
					imagecopyresized($scaled, $img, 0, 0, $x1, $y1, 400, $h, $width, $height);
				}
				$dir = './images/families/';
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
				Yii::trace("FC.actionPhoto saved to $pfile", 'application.controllers.FamilyController');
				$this->redirect(array('view', 'id' => $model->id));
				return;
			} elseif (isset($_FILES['Families'])) {
				Yii::trace("FC.actionPhoto _FILES[Families] set", 'application.controllers.FamilyController');
				$files = $_FILES['Families'];
				$filename = $files['name']['raw_photo'];
				if (isset($filename) and '' != $filename) {
					Yii::trace("FC.actionPhoto filename $filename", 'application.controllers.FamilyController');
					$tmp_path = $files['tmp_name']['raw_photo'];
					if (isset($tmp_path) and '' != $tmp_path) {
						Yii::trace("FC.actionPhoto tmp_path $tmp_path", 'application.controllers.FamilyController');
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
						Yii::trace("FC.actionPhoto file error $error", 'application.controllers.FamilyController');
					}
				}
			}
		} elseif (isset($_FILES['Families'])) {
			$files = $_FILES['Families'];
			$filename = $files['name']['photo'];
			if (isset($filename) and '' != $filename) {
				$tmp_path = $files['tmp_name']['photo'];
				if (isset($tmp_path) and '' != $tmp_path) {
					$dir = "./images/families/";
					$fname = preg_replace('/\.[a-z]+$/i', '', $filename);
					preg_match('/(\.[a-z]+)$/i', $filename, $matches);
					$fext = $matches[0];
					if (file_exists($dir . $filename)) {
						$fname .= "_01";
						while (file_exists($dir. $fname . $fext)) {
							++$fname;
						}
					}
					$dest = $dir . $fname . $fext;
					$model->photo = $fname . $fext;
					if ($model->save()) {
						move_uploaded_file($tmp_path, $dest);
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

	public function actionDependents($id) {
		$model = $this->loadModel($id);
		
		if (isset($_POST['People']['dependent'])) {
			for($i = 0; $i < 10; ++$i) {
				if (isset($_POST['People']['dependent'][$i])) {
					if ($pid = $_POST['People']['dependent'][$i]['id']) {
						$p = People::model()->findByPk($pid);
					} else {
						$p = new People();
					}
					$p->attributes = $_POST['People']['dependent'][$i];
					$p->family_id = $model->id;
					$p->role = 'dependent';
					$p->save();
				}
			}
		}

		$this->render('dependents',array(
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
			Yii::trace("FC.survey awareness reached", 'application.controllers.FamilyController');
			$awarenessItems = AwarenessItem::model()->findAll();

			foreach($awarenessItems as $aRow) {
				$aid = $aRow->id;
				$value = isset($_POST['AwarenessData'][$aid])
					? $_POST['AwarenessData'][$aid] : 1;

				$ad = AwarenessData::model()->findByAttributes(array(
					'family_id' => $id,
					'awareness_id' => $aid
				));

				if (!$ad) {
					$ad = new AwarenessData();
				}

				$ad->value = $value;
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
		$awarenessItems = AwarenessItem::model()->findAll();

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
		$dataProvider=new CActiveDataProvider('Families', array(
			'criteria' => array('condition' => 'disabled = 0'),
		));
		$uri = Yii::app()->request->baseUrl . '/css/family-view.css';
		Yii::app()->clientScript->registerCssFile($uri, 'screen, projection');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	public function actionSearch()
	{
		if (isset($_GET['id'])) {
			$id = $_GET['id'];
			$model=$this->loadModel($id);
			if (preg_match('/^\d+$/', $id)) {
				$this->redirect(array('view','id'=>$model->id));
			}
		} elseif (isset($_GET['key'])) {
			$key = $_GET['key'];
			$crit = new CDbCriteria();
			if (preg_match('/^\d+$/', $key)) {
				$crit->mergeWith(array('condition' => "id = $key"), 'OR');
			}
			$crit->mergeWith(array('condition' => "fid = '$key'"), 'OR');

			$fams = new CActiveDataProvider('Families', array(
				'criteria' => $crit
			));

			if ($fams->itemCount > 0)
				$this->renderPartial('index', array(
					'dataProvider' => $fams
				));
		}
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

		if (isset($_GET['export'])) {
			header( "Content-Type: application/vnd.ms-excel; charset=utf-8" );
			header( "Content-Disposition: inline; filename=\"family-report.xls\"" );

			$dataProvider = $model->search();
			$dataProvider->pagination = false;

			$fields = array('id', 'fid', 'head', 'addr_nm', 'addr_stt', 'addr_area', 'addr_pin', 'zone', 'reg_date', 'marriage_church', 'marriage_date');

			$fval = array();
			$labels = $model->attributeLabels();
			foreach($fields as $field) {
				if ('head' == $field) {
					array_push($fval, 'Family head');
				} else {
					array_push($fval, $labels[$field]);
				}
			}
			echo implode("\t", $fval) . "\n";

            foreach( $dataProvider->data as $data ) {
				$fval = array();
				foreach($fields as $field) {
					if ('head' == $field) {
						$head = $data->head();
						$head_name = '';
						if ($head) {
							$head_name = $head->fullname();
						}
						array_push($fval, $head_name);
					} else {
						array_push($fval, $data->$field);
					}
				}
				echo implode("\t", $fval) . "\n";
			}

			Yii::app()->end();
		}

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function actionSubscriptions($id) {
		$family = Families::model()->findByPk($id);
		
		$subscriptions = Subscription::model()->findAllByAttributes(array(
								'family_id' => $family->id
							), array(
								'order' => 'end_year ASC, end_month ASC'	
							));

		$this->render('subscriptions',array(
			'family' => $family,
			'subscriptions' => $subscriptions
		));
	}

	public function actionVisits($id) {
		$dataProvider=new CActiveDataProvider('Visits', array(
			'criteria' => array('condition' => "family_id = $id")
		));
		$this->render('visits',array(
			'dataProvider'=>$dataProvider,
			'fid'=>$id
		));
	}

	public function actionFindMatch()
	{
		if (Yii::app()->request->isPostRequest) {
			Yii::trace("PC.findMatch POST request", 'application.controllers.FamilyController');
			foreach($_POST as $k => $v) {
				Yii::trace("PC.findMach $k: $v", 'application.controllers.FamilyController');
			}
			$model = Families::model()->findByPk($_POST['family']);
			$family = array(
				'id' => $model->id,
				'head_name' => $model->head_name,
				'marriage_date' => $model->marriage_date,
			);
			echo CJSON::encode($family);
			return;
		}
		$crit = array(
			'condition' => ""
		);
		if (isset($_GET['key'])) {
			$key = $_GET['key'];
			$crit = array(
				'condition' => "t.id = '$key' or t.fid = '$key' or " .
						"h.fname like '%$key%' or h.lname like '%$key%' or " .
						"w.fname like '%$key%' or w.lname like '%$key%'",
				'join' => "LEFT OUTER JOIN people h ON t.husband_id IS NOT NULL " .
						"AND h.id = t.husband_id " .
					"LEFT OUTER JOIN people w ON t.wife_id IS NOT NULL " .
						"AND w.id = t.wife_id",
			);
		}
		$families = new CActiveDataProvider('Families', array('criteria' => $crit));

		$this->renderPartial('find_match', array(
			'families' => $families
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

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

class CollectionController extends RController
{
	public $layout='//layouts/column2';

	public function actionCreate()
	{
		$model=new Transaction;

		if(isset($_POST['Transaction']))
		{
			$model->attributes=$_POST['Transaction'];
			$model->account_id = Account::get('Collection')->id;
			$model->type = 'credit';
			Yii::trace("Transaction account id: " . $model->account_id, 'application.controllers.CollectionController');
			$model->created = Yii::app()->dateFormatter->formatDateTime(time(), 'short', 'medium');
			$model->creator = Yii::app()->user->id;
			$date = $_POST['date'];
			$model->descr = "Collection for $date";

			if($model->save())
				$this->redirect(array('/transaction/view','id'=>$model->id));
		}

		$this->render('create', array(
			'model' => $model
		));
	}

	public function actionView($id)
	{
		$model=Transaction::model()->findByPk($id);
		$this->render('view',array(
			'model'=>$model
		));
	}

	public function actionIndex()
	{
		$dataProvider = new CActiveDataProvider('Transaction', array(
			'criteria' => array(
				'condition' => "account_id = " . Account::get("Collection")->id
			)
		));

		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
}

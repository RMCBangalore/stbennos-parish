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

/**
 * This is the model class for table "individuals".
 *
 * The followings are the available columns in table 'individuals':
 * @property integer $id
 * @property integer $member_id
 *
 * The followings are the available model relations:
 * @property People[] $members
 */
class Individuals extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Individuals the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'individuals';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id', 'safe'),
#			array('photo', 'ImageSizeValidator', 'maxWidth' => 600, 'maxHeight' => 450, 'on' => 'photo'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'members' => array(self::HAS_MANY, 'People', 'unit_id'),
			'member' => array(self::BELONGS_TO, 'People', 'member_id'),
			'unit' => array(self::BELONGS_TO, 'Units', 'id'),
			'satisfactionData' => array(self::HAS_MANY, 'SatisfactionData', 'unit_id'),
			'needData' => array(self::HAS_MANY, 'NeedData', 'unit_id'),
			'awarenessData' => array(self::HAS_MANY, 'AwarenessData', 'unit_id'),
			'openData' => array(self::HAS_MANY, 'OpenData', 'unit_id'),
			'subscriptions' => array(self::HAS_MANY, 'Subscription', 'unit_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'reg_yrs' => 'Registered Years',
			'marriage_church' => 'Marriage Church',
			'marriage_date' => 'Marriage Date',
			'marriage_yrs' => 'Married Years',
			'marriage_type' => 'Marriage Type',
			'marriage_status' => 'Marriage Status',
			'sub_till' => 'Subscription Till',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		if (isset($this->sub_till) and !empty($this->sub_till)) {
			list($pref, $logi, $comp) = array("", " OR ", ">=");
			if (preg_match('/^!/', $this->sub_till)) {
				list($pref, $logi, $comp) = array("NOT ", " AND ", "<");
				$this->setSub_till(preg_replace('/^!/', '', $this->sub_till));
			}
			$mv = explode('-', $this->sub_till);
			Yii::trace("mv isa ".gettype($mv)." size ".count($mv)." = ".join(",",$mv), 'application.models.Individuals');
			if (count($mv) >= 2) {
				list($yr, $mth) = $mv;
				$m = sprintf("%d-%02d", $yr, $mth);
				$criteria->addCondition("$pref EXISTS (SELECT s.id FROM subscriptions s, units u " .
					"WHERE s.unit_id = t.id AND t.id = u.id AND ".
					"CONCAT(s.end_year,'-',LPAD(s.end_month,2,0)) >= '$m') $logi " .
					"LEFT(u.reg_date,7) $comp '$m'");
			}
		}

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	protected function beforeSave()
	{
	    if(parent::beforeSave())
	    {
		// Format dates based on the locale
		foreach($this->metadata->tableSchema->columns as $columnName => $column)
		{
		    if ($column->dbType == 'date' and isset($this->$columnName))
		    {
			$this->$columnName = date('Y-m-d',
			    CDateTimeParser::parse($this->$columnName,
			    Yii::app()->locale->getDateFormat('short')));
		    }
		}
		return true;
	    }
	    else
		return false;
	}

	protected function afterFind()
	{
	    // Format dates based on the locale
	    foreach($this->metadata->tableSchema->columns as $columnName => $column)
	    {           
		if (!strlen($this->$columnName)) continue;
	 
		if ($column->dbType == 'date')
		{ 
		    $this->$columnName = Yii::app()->dateFormatter->formatDateTime(
			    CDateTimeParser::parse(
				$this->$columnName, 
				'yyyy-MM-dd'
			    ),
			    'short',null
			);
		}
	    }
	    return parent::afterFind();
	}

	public static function awarenessData($id) {
		$model = self::model()->findByAttributes(array(
			'id' => $id
		));

		$awarenessData = array();
		foreach ($model->awarenessData as $ad) {
			$awarenessData[$ad->awareness_id] = $ad->value;
		}
		return $awarenessData;
	}

	public static function needData($id) {
		$model = self::model()->findByAttributes(array(
			'id' => $id
		));

		$needData = array();
		foreach ($model->needData as $nd) {
			$needData[$nd->need_id] = $nd->need_value;
		}
		return $needData;
	}

	public static function satisfactionData($id) {
		$model = self::model()->findByAttributes(array(
			'id' => $id
		));

		$satisfactionData = array();
		foreach ($model->satisfactionData as $sd) {
			$satisfactionData[$sd->satisfaction_item_id] = $sd->satisfaction_value;
		}
		return $satisfactionData;
	}

	public function head() {
		return isset($this->member_id) ? $this->member : null;
	}

}

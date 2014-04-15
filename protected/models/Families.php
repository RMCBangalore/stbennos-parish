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
 * This is the model class for table "families".
 *
 * The followings are the available columns in table 'families':
 * @property integer $id
 * @property string $uid
 * @property integer $reg_yrs
 * @property string $marriage_church
 * @property string $marriage_date
 * @property string $marriage_yrs
 * @property string $marriage_type
 * @property string $marriage_status
 * @property integer $husband_id
 * @property integer $wife_id
 *
 * The followings are the available model relations:
 * @property People[] $members
 */
class Families extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Families the static model class
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
		return 'families';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('uid, marriage_date, marriage_church, marriage_type, marriage_status', 'required'),
			array('uid', 'unique'),
			array('uid', 'length', 'max'=>11),
			array('marriage_church', 'length', 'max'=>50),
			array('marriage_type, marriage_status', 'length', 'max'=>25),
			array('id, marriage_date', 'safe'),
			array('marriage_date', 'default', 'setOnEmpty' => true, 'value' => null),
			array('marriage_date', 'type', 'type' => 'date', 'message' => '{attribute}: is not a date!', 'dateFormat' => Yii::app()->locale->getDateFormat('short')),
			array('photo', 'ImageSizeValidator', 'maxWidth' => 600, 'maxHeight' => 450, 'on' => 'photo'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, uid, reg_yrs, marriage_church, marriage_date, marriage_yrs, ' .
				'marriage_type, marriage_status, sub_till, addr_nm, addr_stt, ' .
				'addr_area, addr_pin, mobile, email, zone, bpl_card, ' .
				'monthly_income, photo, gmap_url, reg_date, disabled, ' .
				'leaving_date', 'safe', 'on'=>'search'),
		);
	}

	public function getSub_till() {
		$subs = $this->subscriptions;
		if ($subs) {
			return $subs[count($subs) - 1]->till_month;
		} else {
			return !$this->isNewRecord ? $this->unit->reg_date : null;
		}
	}

	public function setSub_till($val) {
		Yii::trace("F.setSub_till val = $val", 'application.models.Families');
		$this->sub_till = $val;
	}

	public function getHead_name() {
		$head = $this->head();
		return isset($head) ? $head->fullname() : '';
	}

	public function getReg_yrs() {
		return !$this->isNewRecord and $this->unit->reg_date ? (strtotime('now') - strtotime($this->unit->reg_date)) / (60*60*24*365.2425) : null;
	}

	public function setReg_yrs($val) {
		$this->reg_yrs = $val;
	}

	public function getMarriage_yrs() {
		return $this->marriage_date ? (strtotime('now') - strtotime($this->marriage_date)) / (60*60*24*365.2425) : null;
	}

	public function setMarriage_yrs($val) {
		$this->marriage_yrs = $val;
	}

	public function setUid($val) {
		$this->uid = $val;
	}

	public function setAddr_nm($val) {
		$this->addr_nm = $val;
	}

	public function setAddr_stt($val) {
		$this->addr_stt = $val;
	}

	public function setAddr_area($val) {
		$this->addr_area = $val;
	}

	public function setAddr_pin($val) {
		$this->addr_pin = $val;
	}

	public function setPhone($val) {
		$this->phone = $val;
	}

	public function setMobile($val) {
		$this->mobile = $val;
	}

	public function setEmail($val) {
		$this->email = $val;
	}

	public function setZone($val) {
		$this->zone = $val;
	}

	public function setBpl_card($val) {
		$this->bpl_card = $val;
	}

	public function setMonthly_income($val) {
		$this->monthly_income = $val;
	}

	public function setPhoto($val) {
		$this->photo = $val;
	}

	public function setGmap_url($val) {
		$this->gmap_url = $val;
	}

	public function setReg_date($val) {
		$this->reg_date = $val;
	}

	public function setDisabled($val) {
		$this->disabled = $val;
	}

	public function setLeaving_date($val) {
		$this->leaving_date = $val;
	}

	public function getUid() {
		return !$this->isNewRecord ? $this->unit->uid : null;
	}

	public function getAddr_nm() {
		return !$this->isNewRecord ? $this->unit->addr_nm : null;
	}

	public function getAddr_stt() {
		return !$this->isNewRecord ? $this->unit->addr_stt : null;
	}

	public function getAddr_area() {
		return !$this->isNewRecord ? $this->unit->addr_area : null;
	}

	public function getAddr_pin() {
		return !$this->isNewRecord ? $this->unit->addr_pin : null;
	}

	public function getPhone() {
		return !$this->isNewRecord ? $this->unit->phone : null;
	}

	public function getMobile() {
		return !$this->isNewRecord ? $this->unit->mobile : null;
	}

	public function getEmail() {
		return !$this->isNewRecord ? $this->unit->email : null;
	}

	public function getZone() {
		return !$this->isNewRecord ? $this->unit->zone : null;
	}

	public function getBpl_card() {
		return !$this->isNewRecord ? $this->unit->bpl_card : null;
	}

	public function getMonthly_income() {
		return !$this->isNewRecord ? $this->unit->monthly_income : null;
	}

	public function getPhoto() {
		return !$this->isNewRecord ? $this->unit->photo : null;
	}

	public function getGmap_url() {
		return !$this->isNewRecord ? $this->unit->gmap_url : null;
	}

	public function getReg_date() {
		return !$this->isNewRecord ? $this->unit->reg_date : null;
	}

	public function getDisabled() {
		return !$this->isNewRecord ? $this->unit->disabled : null;
	}

	public function getLeaving_date() {
		return !$this->isNewRecord ? $this->unit->leaving_date : null;
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
			'husband' => array(self::BELONGS_TO, 'People', 'husband_id'),
			'wife' => array(self::BELONGS_TO, 'People', 'wife_id'),
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
			'uid' => 'Family Code',
			'reg_yrs' => 'Registered Years',
			'marriage_church' => 'Marriage Church',
			'marriage_date' => 'Marriage Date',
			'marriage_yrs' => 'Married Years',
			'marriage_type' => 'Marriage Type',
			'marriage_status' => 'Marriage Status',
			'sub_till' => 'Subscription Till',
		);
	}

	protected function date_search($criteria, $dt_col, $yr_col) {
		$yr_val = $this->$yr_col;
		Yii::trace("P.search by $yr_col", 'application.models.People');
		if (preg_match('/^(\d+)-(\d+)$/', $yr_val, $matches) or preg_match('/^(\d+)\.\.(\d+)$/', $yr_val, $matches)) {
			$lim_max = "" . (date_format(new DateTime('now'), 'Y') - $matches[1])
						. date_format(new DateTime('now'), '-m-d');
			$lim_min = "" . (date_format(new DateTime('now'), 'Y') - $matches[2] - 1)
						. date_format(new DateTime('now'), '-m-d');
			Yii::trace("P.search $yr_col bw {$matches[1]} and {$matches[2]}", 'application.models.People');
			Yii::trace("P.search $dt_col bw $lim_min and $lim_max", 'application.models.People');
			$criteria = $criteria->addCondition("$dt_col between '$lim_min' and '$lim_max'");
		} elseif (preg_match('/^(>|<|<=|>=|<>)(\d+)$/', $yr_val, $matches)) {
			if (preg_match('/^[<=]+$/', $matches[1])) {
				$sgn = preg_replace('/</', '>', $matches[1]);
			} elseif (preg_match('/^[>=]+$/', $matches[1])) {
				$sgn = preg_replace('/>/', '<', $matches[1]);
			} else {
				$sgn = $matches[1];
			}

			$lim = "" . (date_format(new DateTime('now'), 'Y') - $matches[2])
						. date_format(new DateTime('now'), '-m-d');
			Yii::trace("P.search $dt_col $sgn $lim", 'application.models.People');
			$criteria = $criteria->addCondition("$dt_col $sgn '$lim'");
		} elseif (preg_match('/^(\d+)$/', $yr_val, $matches)) {
			$lim_max = "" . (date_format(new DateTime('now'), 'Y') - $matches[1])
						. date_format(new DateTime('now'), '-m-d');
			$lim_min = "" . (date_format(new DateTime('now'), 'Y') - $matches[1] - 1)
						. date_format(new DateTime('now'), '-m-d');
			Yii::trace("P.search $yr_col = {$matches[1]} years", 'application.models.People');
			Yii::trace("P.search $dt_col bw $lim_min and $lim_max", 'application.models.People');
			$criteria = $criteria->addCondition("$dt_col between '$lim_min' and '$lim_max'");
		}
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
		$criteria->compare('marriage_church',$this->marriage_church,true);
		if (isset($this->marriage_date) and $this->marriage_date) {
			$criteria->compare('marriage_date', date('Y-m-d',
				    CDateTimeParser::parse($this->marriage_date,
				    Yii::app()->locale->getDateFormat('short'))));
		}
		if (isset($this->marriage_yrs)) {
			$this->date_search($criteria, 'marriage_date', 'marriage_yrs');
		}
		$criteria->compare('marriage_type',$this->marriage_type,true);
		$criteria->compare('marriage_status',$this->marriage_status,true);
		if (isset($this->sub_till) and !empty($this->sub_till)) {
			list($pref, $logi, $comp) = array("", " OR ", ">=");
			if (preg_match('/^!/', $this->sub_till)) {
				list($pref, $logi, $comp) = array("NOT ", " AND ", "<");
				$this->setSub_till(preg_replace('/^!/', '', $this->sub_till));
			}
			$mv = explode('-', $this->sub_till);
			Yii::trace("mv isa ".gettype($mv)." size ".count($mv)." = ".join(",",$mv), 'application.models.Families');
			if (count($mv) >= 2) {
				list($yr, $mth) = $mv;
				$m = sprintf("%d-%02d", $yr, $mth);
				$criteria->addCondition("$pref EXISTS (SELECT s.id FROM subscriptions s, units u " .
					"WHERE s.unit_id = t.id AND t.id = u.id AND ".
					"CONCAT(s.end_year,'-',LPAD(s.end_month,2,0)) >= '$m') $logi " .
					"LEFT(u.reg_date,7) $comp '$m'");
			}
		}

		$ucond = array();
		if (isset($this->uid) and !empty($this->uid)) {
			array_push($ucond, "u.uid = '" . $this->uid . "'");
		}
		if (isset($this->addr_nm) and !empty($this->addr_nm)) {
			array_push($ucond, "u.addr_nm like '%" . $this->addr_nm . "%'");
		}
		if (isset($this->addr_stt) and !empty($this->addr_stt)) {
			array_push($ucond, "u.addr_stt like '%" . $this->addr_stt . "%'");
		}
		if (isset($this->addr_area) and !empty($this->addr_area)) {
			array_push($ucond, "u.addr_area like '%" . $this->addr_area . "%'");
		}
		if (isset($this->addr_pin) and !empty($this->addr_pin)) {
			array_push($ucond, "u.addr_pin like '%" . $this->addr_pin . "%'");
		}
		if (isset($this->phone) and !empty($this->phone)) {
			array_push($ucond, "u.phone like '%" . $this->phone . "%'");
		}
		if (isset($this->mobile) and !empty($this->mobile)) {
			array_push($ucond, "u.mobile like '%" . $this->mobile . "%'");
		}
		if (isset($this->email) and !empty($this->email)) {
			array_push($ucond, "u.email like '%" . $this->email . "%'");
		}
		if (isset($this->zone) and !empty($this->zone)) {
			array_push($ucond, "u.zone = " . $this->zone);
		}
		if (isset($this->bpl_card) and !empty($this->bpl_card)) {
			array_push($ucond, "u.bpl_card = " . $this->bpl_card);
		}
		if (isset($this->monthly_income) and !empty($this->monthly_income)) {
			array_push($ucond, "u.monthly_income = " . $this->monthly_income);
		}
		if (isset($this->reg_date) and !empty($this->reg_date)) {
			array_push($ucond, "u.reg_date like '%" . $this->reg_date . "%'");
		}
		if (isset($this->disabled) and !empty($this->disabled)) {
			array_push($ucond, "u.disabled = " . $this->disabled);
		}
		if (isset($this->leaving_date) and !empty($this->leaving_date)) {
			array_push($ucond, "u.leaving_date like '%" . $this->leaving_date . "%'");
		}
		$uc = false;
		if (count($ucond) > 0) {
			$uc = true;
			$criteria->mergeWith(array(
				'join' => 'INNER JOIN units u ON u.id = t.id',
				'condition' => implode(" AND ", $ucond),
			));
		}
		if (isset($this->reg_yrs) and !empty($this->reg_yrs)) {
			$this->date_search($criteria, "u.reg_date", "reg_yrs");
			if (!$uc) {
				$criteria->mergeWith(array(
					'join' => 'INNER JOIN units u ON u.id = t.id'
				));
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

	public function children() {
		$p = new People();
		return $p->findAllByAttributes(array(
			'role' => 'child',
			'unit_id' => $this->id
		));
	}

	public function dependents() {
		$p = new People();
		return $p->findAllByAttributes(array(
			'role' => 'dependent',
			'unit_id' => $this->id
		));
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
		return isset($this->husband_id) ? $this->husband : $this->wife;
	}

}

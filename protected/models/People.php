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
 * This is the model class for table "people".
 *
 * The followings are the available columns in table 'people':
 * @property integer $id
 * @property string $fname
 * @property string $lname
 * @property integer $sex
 * @property string $domicile_status
 * @property string $dob
 * @property string $education
 * @property string $profession
 * @property string $occupation
 * @property string $remarks
 * @property string $mobile
 * @property string $email
 * @property string $lang_pri
 * @property string $lang_lit
 * @property string $lang_edu
 * @property string $rite
 * @property string $baptism_dt
 * @property string $baptism_church
 * @property string $baptism_place
 * @property string $god_parents
 * @property string $first_comm_dt
 * @property string $confirmation_dt
 * @property string $marriage_dt
 * @property string $death_dt
 * @property string $cemetery_church
 * @property integer $family_id
 * @property string $role
 * @property string $special_skill
 * @property string $photo
 * @property integer $blood_group
 * @property string $aadhar_no
 * @property string $voter_id
 * @property string $mid
 *
 * The followings are the available model relations:
 * @property Families $family
 * @property MembershipCerts[] $membershipCerts
 */
class People extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return People the static model class
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
		return 'people';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fname, lname, sex', 'required'),
			array('sex, family_id, blood_group', 'numerical', 'integerOnly'=>true),
			array('fname, email, baptism_church, god_parents', 'length', 'max'=>50),
			array('lname, profession, occupation, lang_pri, lang_lit, lang_edu, rite, cemetery_church, special_skill', 'length', 'max'=>25),
			array('domicile_status', 'length', 'max'=>4),
			array('education, baptism_place', 'length', 'max'=>15),
			array('aadhar_no, voter_id', 'length', 'max'=>25),
			array('mobile, role, mid', 'length', 'max'=>10),
			array('photo', 'ImageSizeValidator', 'maxWidth' => 150, 'maxHeight' => 200, 'on' => 'photo'),
			array('age, baptised_yrs, first_comm_yrs, confirmation_yrs, marriage_yrs', 'safe', 'on' => 'search'),
			array('dob, baptism_dt, first_comm_dt, confirmation_dt, marriage_dt', 'safe'),
/*			array('baptism_dt, first_comm_dt, confirmation_dt, marriage_dt', 'compare', 'compareAttribute' => 'dob', 'allowEmpty' => true,
					'operator' => '>=', 'message' => 'Must not be before date of birth'),
			array('first_comm_dt, confirmation_dt, marriage_dt', 'compare', 'compareAttribute' => 'baptism_dt', 'allowEmpty' => true,
					'operator' => '>=', 'message' => 'Must not be before baptism date'),
			array('marriage_dt', 'compare', 'compareAttribute' => 'confirmation_dt', 'allowEmpty' => true,
					'operator' => '>=', 'message' => 'Must not be before confirmation date'),*/
			array('dob, baptism_dt, first_comm_dt, confirmation_dt, marriage_dt, death_dt', 'default', 'setOnEmpty' => true, 'value' => null),
			array('dob, baptism_dt, first_comm_dt, confirmation_dt, marriage_dt, death_dt', 'type', 'type' => 'date', 'message' => '{attribute}: is not a date!', 'dateFormat' => Yii::app()->locale->getDateFormat('short')),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, fname, lname, sex, age, domicile_status, dob, education, profession, occupation, mobile, email, lang_pri, lang_lit, lang_edu, rite, baptism_dt, baptism_church, baptism_place, god_parents, first_comm_dt, confirmation_dt, marriage_dt, cemetery_church, family_id, role, special_skill, mid, remarks, death_dt', 'safe', 'on'=>'search'),
		);
	}

	public function getAge() {
		return $this->dob ? (strtotime('now') - strtotime($this->dob)) / (60*60*24*365.2425) : null;
	}

	public function setAge($val) {
		$this->age = $val;
	}

	public function getBaptised_yrs() {
		return $this->baptism_dt ? (strtotime('now') - strtotime($this->baptism_dt)) / (60*60*24*365.2425) : null;
	}

	public function setBaptised_yrs($val) {
		$this->baptised_yrs = $val;
	}

	public function getFirst_comm_yrs() {
		return $this->first_comm_dt ? (strtotime('now') - strtotime($this->first_comm_dt)) / (60*60*24*365.2425) : null;
	}

	public function setFirst_comm_yrs($val) {
		$this->first_comm_yrs = $val;
	}

	public function getConfirmation_yrs() {
		return $this->confirmation_dt ? (strtotime('now') - strtotime($this->confirmation_dt)) / (60*60*24*365.2425) : null;
	}

	public function setConfirmation_yrs($val) {
		$this->confirmation_yrs = $val;
	}

	public function getMarriage_yrs() {
		return $this->marriage_dt ? (strtotime('now') - strtotime($this->marriage_dt)) / (60*60*24*365.2425) : null;
	}

	public function setMarriage_yrs($val) {
		$this->marriage_yrs = $val;
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'family' => array(self::BELONGS_TO, 'Families', 'family_id'),
			'membershipCerts' => array(self::HAS_MANY, 'MembershipCerts', 'member_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'fname' => 'First Name',
			'lname' => 'Last Name',
			'sex' => 'Sex',
			'domicile_status' => 'Domicile Status',
			'age' => 'Age',
			'dob' => 'Dob',
			'education' => 'Education',
			'profession' => 'Profession',
			'occupation' => 'Occupation',
			'mobile' => 'Mobile',
			'email' => 'Email',
			'lang_pri' => 'Primary Language',
			'lang_lit' => 'Language of Liturgy',
			'lang_edu' => 'Language of Education',
			'rite' => 'Rite',
			'baptism_dt' => 'Baptism Date',
			'baptised_yrs' => 'Baptised Years',
			'baptism_church' => 'Baptism Church',
			'baptism_place' => 'Baptism Place',
			'god_parents' => 'God Parents',
			'first_comm_dt' => 'First Communion Date',
			'first_comm_yrs' => 'First Communion Years',
			'confirmation_dt' => 'Confirmation Date',
			'confirmation_yrs' => 'Confirmation Years',
			'marriage_dt' => 'Marriage Date',
			'marriage_yrs' => 'Marriage Years',
			'cemetery_church' => 'Cemetery Church',
			'family_id' => 'Family',
			'role' => 'Role',
			'special_skill' => 'Special Skill',
			'mid' => 'Member Id',
			'remarks' => 'Remarks',
			'death_dt' => 'Death Date',
			'voter_id' => 'Election ID',
			'aadhar_no' => 'Aadhar Card No',
			'blood_group' => 'Blood Group',
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
		$criteria->compare('fname',$this->fname,true);
		$criteria->compare('lname',$this->lname,true);
		$criteria->compare('sex',$this->sex);
		$criteria->compare('domicile_status',$this->domicile_status,true);
		if (isset($this->dob) and $this->dob) {
			$criteria->compare('dob', date('Y-m-d',
				CDateTimeParser::parse($this->dob,
				Yii::app()->locale->getDateFormat('short'))),true);
		}
		if (isset($this->age)) {
			$this->date_search($criteria, 'dob', 'age');
		}
		$criteria->compare('education',$this->education,true);
		$criteria->compare('profession',$this->profession,true);
		$criteria->compare('occupation',$this->occupation,true);
		$criteria->compare('special_skill',$this->special_skill,true);
		$criteria->compare('remarks',$this->remarks,true);
		$criteria->compare('mobile',$this->mobile,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('lang_pri',$this->lang_pri,true);
		$criteria->compare('lang_lit',$this->lang_lit,true);
		$criteria->compare('lang_edu',$this->lang_edu,true);
		$criteria->compare('rite',$this->rite,true);
		if (isset($this->baptism_dt) and $this->baptism_dt) {
			$criteria->compare('baptism_dt', date('Y-m-d',
				CDateTimeParser::parse($this->baptism_dt,
				Yii::app()->locale->getDateFormat('short'))),true);
		}
		if (isset($this->baptised_yrs)) {
			$this->date_search($criteria, 'baptism_dt', 'baptised_yrs');
		}
		$criteria->compare('baptism_church',$this->baptism_church,true);
		$criteria->compare('baptism_place',$this->baptism_place,true);
		$criteria->compare('god_parents',$this->god_parents,true);
		if (isset($this->first_comm_dt) and $this->first_comm_dt) {
			$criteria->compare('first_comm_dt', date('Y-m-d',
				CDateTimeParser::parse($this->first_comm_dt,
				Yii::app()->locale->getDateFormat('short'))),true);
		}
		if (isset($this->first_comm_yrs)) {
			$this->date_search($criteria, 'first_comm_dt', 'first_comm_yrs');
		}
		if (isset($this->confirmation_dt) and $this->confirmation_dt) {
			$criteria->compare('confirmation_dt', date('Y-m-d',
				CDateTimeParser::parse($this->confirmation_dt,
				Yii::app()->locale->getDateFormat('short'))),true);
		}
		if (isset($this->confirmation_yrs)) {
			$this->date_search($criteria, 'confirmation_dt', 'confirmation_yrs');
		}
		if (isset($this->marriage_dt) and $this->marriage_dt) {
			$criteria->compare('marriage_dt', date('Y-m-d',
				CDateTimeParser::parse($this->marriage_dt,
				Yii::app()->locale->getDateFormat('short'))),true);
		}
		if (isset($this->marriage_yrs)) {
			$this->date_search($criteria, 'marriage_dt', 'marriage_yrs');
		}
		if (isset($this->death_dt) and $this->death_dt) {
			$criteria->compare('death_dt', date('Y-m-d',
				CDateTimeParser::parse($this->death_dt,
				Yii::app()->locale->getDateFormat('short'))),true);
		}
		$criteria->compare('cemetery_church',$this->cemetery_church,true);
		$criteria->compare('family_id',$this->family_id);
		$criteria->compare('role',$this->role,true);
		$criteria->compare('special_skill',$this->special_skill,true);
		$criteria->compare('mid',$this->mid,true);

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
		    if ($column->dbType == 'date' and isset($this->$columnName) and $this->$columnName)
		    {
			$this->$columnName = date('Y-m-d',
			    CDateTimeParser::parse($this->$columnName,
			    Yii::app()->locale->getDateFormat('short')));
		    }
		}
		if (!isset($this->mid)) { 
			$cond = "family_id=:fid";
			$parms = array(':fid'=>$this->family_id);
			if (isset($this->id)) {
				$parms[':id'] = $this->id;
				$recs = People::model()->findAll(array(
					'condition' => "$cond and id<=:id",
					'params' => $parms
				));
				$cnt = count($recs);
			} else {
				$recs = People::model()->findAll(array(
					'condition' => $cond,
					'params' => $parms
				));
				$cnt = 1 + count($recs);
			}
			$family = Families::model()->findByPk($this->family_id);
			$this->mid = $family->fid . "/$cnt";
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

	public function getBaptised() {
		return self::model()->findAll('baptism_dt is not null');
	}

	public function getConfirmed() {
		return self::model()->findAll('confirmation_dt is not null');
	}

	public function getMarried() {
		return self::model()->findAll('marriage_dt is not null');
	}

	public function getParent() {
		$f = $this->family;
		if (isset($f->husband_id)) {
			return $f->husband;
		} elseif (isset($f->wife_id)) {
			return $f->wife;
		}
		return null;
	}

	public function getFathers_name() {
		if ($this->role != 'child') return '';
		$f = $this->family;
		return isset($f->husband_id) ? $f->husband->fullname() : '';
	}

	public function getMothers_name() {
		if ($this->role != 'child') return '';
		$f = $this->family;
		return isset($f->wife_id) ? $f->wife->fullname() : '';
	}

	public function fullname() {
		if (isset($this->fname)) {
			if (isset($this->lname)) {
				return $this->fname . " " . $this->lname;
			} else {
				return $this->fname;
			}
		} else {
			return $this->lname;
		}
	}

	public function get_mid() {
		$recs = People::model()->findAll(array(
			'condition' => 'family_id=:fid and id<=:id',
			'params'	=> array(':fid'=>$this->family_id, ':id'=>$this->id)
		));
		return $this->family->fid . '/' . count($recs);
	}

	public static function getAutoCompleteFields() {
		$people = People::model()->findAll();
		$specialSkills = array();
		$professions = array();
		$occupations = array();
		$churches = array();
		$baptism_places = array();
		$cemetery_churches = array();
		foreach($people as $p) {
			if (!isset($specialSkills[$p->special_skill])) {
				$specialSkills[$p->special_skill] = 1;
			}
			if (!isset($professions[$p->profession])) {
				$professions[$p->profession] = 1;
			}
			if (!isset($occupations[$p->occupation])) {
				$occupations[$p->occupation] = 1;
			}
			if (!isset($baptism_churches[$p->baptism_church])) {
				$churches[$p->baptism_church] = 1;
			}
			if (!isset($baptism_places[$p->baptism_place])) {
				$baptism_places[$p->baptism_place] = 1;
			}
			if (!isset($cemetery_churches[$p->cemetery_church])) {
				$cemetery_churches[$p->cemetery_church] = 1;
			}
		}
		$families = Families::model()->findAll();
		foreach($families as $fam) {
			if (!isset($churches[$fam->marriage_church])) {
				$churches[$fam->marriage_church] = 1;
			}
		}
		return array(
			'special_skills' => array_keys($specialSkills),
			'professions'	 => array_keys($professions),
			'occupations'	 => array_keys($occupations),
			'churches'	 => array_keys($churches),
			'baptism_places'	 => array_keys($baptism_places),
			'cemetery_churches'	 => array_keys($cemetery_churches),
		);
	}
}

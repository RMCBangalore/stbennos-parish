<?php

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
 * @property string $cemetery_church
 * @property integer $family_id
 * @property string $role
 * @property string $special_skill
 * @property string $photo
 *
 * The followings are the available model relations:
 * @property Families $family
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
			array('fname, lname, sex, domicile_status, dob, lang_pri, lang_lit, baptism_dt, baptism_church, baptism_place, god_parents', 'required'),
			array('sex, family_id', 'numerical', 'integerOnly'=>true),
			array('fname, email, baptism_church, god_parents', 'length', 'max'=>50),
			array('lname, profession, occupation, lang_pri, lang_lit, lang_edu, rite, cemetery_church, special_skill', 'length', 'max'=>25),
			array('domicile_status', 'length', 'max'=>4),
			array('education, baptism_place', 'length', 'max'=>15),
			array('mobile, role', 'length', 'max'=>10),
			array('photo', 'ImageSizeValidator', 'maxWidth' => 150, 'maxHeight' => 200, 'on' => 'photo'),
			array('dob, baptism_dt, first_comm_dt, confirmation_dt, marriage_dt', 'safe'),
			array('dob, baptism_dt, first_comm_dt, confirmation_dt, marriage_dt', 'default', 'setOnEmpty' => true, 'value' => null),
			array('dob, baptism_dt, first_comm_dt, marriage_dt', 'type', 'type' => 'date', 'message' => '{attribute}: is not a date!', 'dateFormat' => 'yyyy-MM-dd'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, fname, lname, sex, age, domicile_status, dob, education, profession, occupation, mobile, email, lang_pri, lang_lit, lang_edu, rite, baptism_dt, baptism_church, baptism_place, god_parents, first_comm_dt, confirmation_dt, marriage_dt, cemetery_church, family_id, role, special_skill', 'safe', 'on'=>'search'),
		);
	}

	public function getAge() {
		return (strtotime('now') - strtotime($this->dob)) / (60*60*24*365.2425);
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
			'baptism_church' => 'Baptism Church',
			'baptism_place' => 'Baptism Place',
			'god_parents' => 'God Parents',
			'first_comm_dt' => 'First Communion Date',
			'confirmation_dt' => 'Confimation Date',
			'marriage_dt' => 'Marriage Date',
			'cemetery_church' => 'Cemetery Church',
			'family_id' => 'Family',
			'role' => 'Role',
			'special_skill' => 'Special Skill',
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
		$criteria->compare('fname',$this->fname,true);
		$criteria->compare('lname',$this->lname,true);
		$criteria->compare('sex',$this->sex);
		$criteria->compare('domicile_status',$this->domicile_status,true);
		$criteria->compare('dob',$this->dob,true);
#		$criteria->compare('age',$this->age);
		$criteria->compare('education',$this->education,true);
		$criteria->compare('profession',$this->profession,true);
		$criteria->compare('occupation',$this->occupation,true);
		$criteria->compare('mobile',$this->mobile,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('lang_pri',$this->lang_pri,true);
		$criteria->compare('lang_lit',$this->lang_lit,true);
		$criteria->compare('lang_edu',$this->lang_edu,true);
		$criteria->compare('rite',$this->rite,true);
		$criteria->compare('baptism_dt',$this->baptism_dt,true);
		$criteria->compare('baptism_church',$this->baptism_church,true);
		$criteria->compare('baptism_place',$this->baptism_place,true);
		$criteria->compare('god_parents',$this->god_parents,true);
		$criteria->compare('first_comm_dt',$this->first_comm_dt,true);
		$criteria->compare('confirmation_dt',$this->confirmation_dt,true);
		$criteria->compare('marriage_dt',$this->marriage_dt,true);
		$criteria->compare('cemetery_church',$this->cemetery_church,true);
		$criteria->compare('family_id',$this->family_id);
		$criteria->compare('role',$this->role,true);
		$criteria->compare('special_skill',$this->special_skill,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
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
}

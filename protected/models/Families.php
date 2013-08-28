<?php

/**
 * This is the model class for table "families".
 *
 * The followings are the available columns in table 'families':
 * @property integer $id
 * @property string $fid
 * @property string $addr_nm
 * @property string $addr_stt
 * @property string $addr_area
 * @property string $addr_pin
 * @property string $phone
 * @property string $mobile
 * @property string $email
 * @property integer $zone
 * @property integer $reg_date
 * @property integer $bpl_card
 * @property string $marriage_church
 * @property string $marriage_date
 * @property string $marriage_type
 * @property string $marriage_status
 * @property string $monthly_income
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
			array('addr_stt, addr_area, addr_pin, zone, marriage_date, marriage_church, marriage_type, marriage_status', 'required'),
			array('fid', 'unique'),
			array('zone', 'numerical', 'integerOnly'=>true),
			array('fid', 'length', 'max'=>11),
			array('addr_nm, addr_stt, email, marriage_church', 'length', 'max'=>50),
			array('addr_area, marriage_type, marriage_status', 'length', 'max'=>25),
			array('addr_pin', 'length', 'max'=>7),
			array('phone, mobile', 'length', 'max'=>10),
			array('monthly_income', 'length', 'max'=>15),
			array('marriage_date, bpl_card', 'safe'),
			array('marriage_date, reg_date', 'type', 'type' => 'date', 'message' => '{attribute}: is not a date!', 'dateFormat' => 'yyyy-MM-dd'),
			array('photo', 'ImageSizeValidator', 'maxWidth' => 600, 'maxHeight' => 450, 'on' => 'photo'),
			array('gmap_url', 'url'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, fid, addr_nm, addr_stt, addr_area, addr_pin, phone, mobile, email, zone, reg_date, bpl_card, marriage_church, marriage_date, marriage_type, marriage_status, monthly_income', 'safe', 'on'=>'search'),
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
			'members' => array(self::HAS_MANY, 'People', 'family_id'),
			'husband' => array(self::BELONGS_TO, 'People', 'husband_id'),
			'wife' => array(self::BELONGS_TO, 'People', 'wife_id'),
			'satisfactionData' => array(self::HAS_MANY, 'SatisfactionData', 'family_id'),
			'needData' => array(self::HAS_MANY, 'NeedData', 'family_id'),
			'awarenessData' => array(self::HAS_MANY, 'AwarenessData', 'family_id'),
			'openData' => array(self::HAS_MANY, 'OpenData', 'family_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'fid' => 'Family Id',
			'addr_nm' => 'House No./Name',
			'addr_stt' => 'Street Address',
			'addr_area' => 'Area',
			'addr_pin' => 'Pin Code',
			'phone' => 'Phone',
			'mobile' => 'Mobile',
			'email' => 'Email',
			'zone' => 'Zone',
			'gmap_url' => 'Google maps URL',
			'reg_date' => 'Registration Date',
			'bpl_card' => 'Bpl Card',
			'marriage_church' => 'Marriage Church',
			'marriage_date' => 'Marriage Date',
			'marriage_type' => 'Marriage Type',
			'marriage_status' => 'Marriage Status',
			'monthly_income' => 'Monthly Household Income',
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
		$criteria->compare('fid',$this->fid,true);
		$criteria->compare('addr_nm',$this->addr_nm,true);
		$criteria->compare('addr_stt',$this->addr_stt,true);
		$criteria->compare('addr_area',$this->addr_area,true);
		$criteria->compare('addr_pin',$this->addr_pin,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('mobile',$this->mobile,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('zone',$this->zone);
		$criteria->compare('reg_date',$this->reg_date);
		$criteria->compare('bpl_card',$this->bpl_card);
		$criteria->compare('marriage_church',$this->marriage_church,true);
		$criteria->compare('marriage_date',$this->marriage_date,true);
		$criteria->compare('marriage_type',$this->marriage_type,true);
		$criteria->compare('marriage_status',$this->marriage_status,true);
		$criteria->compare('monthly_income',$this->monthly_income,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function children() {
		$p = new People();
		return $p->findAllByAttributes(array(
			'role' => 'child',
			'family_id' => $this->id
		));
	}

	public function dependents() {
		$p = new People();
		return $p->findAllByAttributes(array(
			'role' => 'dependent',
			'family_id' => $this->id
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

<?php

/**
 * This is the model class for table "parish".
 *
 * The followings are the available columns in table 'parish':
 * @property string $name
 * @property string $address
 * @property string $city
 * @property string $pin
 * @property integer $est_year
 * @property double $mass_book_basic
 * @property double $mass_book_sun
 * @property integer $isset
 * @property string $logo_src
 * @property integer $logo_width
 * @property integer $logo_height
 */
class Parish extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Parish the static model class
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
		return 'parish';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, address, city, pin, est_year, mass_book_basic, mass_book_sun', 'required'),
			array('est_year, isset, logo_width, logo_height', 'numerical', 'integerOnly'=>true),
			array('mass_book_basic, mass_book_sun', 'numerical'),
			array('name, logo_src', 'length', 'max'=>50),
			array('city', 'length', 'max'=>25),
			array('pin', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('name, address, city, pin, est_year, mass_book_basic, mass_book_sun, isset, logo_src, logo_width, logo_height', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'name' => 'Name',
			'address' => 'Address',
			'city' => 'City',
			'pin' => 'Pin',
			'est_year' => 'Established Year',
			'mass_book_basic' => 'Mass Booking Amount (Weekdays)',
			'mass_book_sun' => 'Mass Booking (Sundays / Feast days)',
			'isset' => 'Isset',
			'logo_src' => 'Logo Src',
			'logo_width' => 'Logo Width',
			'logo_height' => 'Logo Height',
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

		$criteria->compare('name',$this->name,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('pin',$this->pin,true);
		$criteria->compare('est_year',$this->est_year);
		$criteria->compare('mass_book_basic',$this->mass_book_basic);
		$criteria->compare('mass_book_sun',$this->mass_book_sun);
		$criteria->compare('isset',$this->isset);
		$criteria->compare('logo_src',$this->logo_src,true);
		$criteria->compare('logo_width',$this->logo_width);
		$criteria->compare('logo_height',$this->logo_height);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public static function get() {
		return Parish::model()->find();
	}
}

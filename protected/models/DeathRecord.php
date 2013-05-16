<?php

/**
 * This is the model class for table "deaths".
 *
 * The followings are the available columns in table 'deaths':
 * @property integer $id
 * @property string $death_dt
 * @property string $cause
 * @property string $fname
 * @property string $lname
 * @property double $age
 * @property string $profession
 * @property string $buried_dt
 * @property string $minister
 * @property string $burial_place
 * @property string $ref_no
 *
 * The followings are the available model relations:
 * @property DeathCerts[] $deathCerts
 */
class DeathRecord extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DeathRecord the static model class
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
		return 'deaths';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('death_dt', 'required'),
			array('age', 'numerical'),
			array('cause', 'length', 'max'=>100),
			array('fname', 'length', 'max'=>50),
			array('lname, profession, burial_place', 'length', 'max'=>25),
			array('minister', 'length', 'max'=>75),
			array('ref_no', 'length', 'max'=>10),
			array('buried_dt', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, death_dt, cause, fname, lname, age, profession, buried_dt, minister, burial_place, ref_no', 'safe', 'on'=>'search'),
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
			'deathCerts' => array(self::HAS_MANY, 'DeathCerts', 'death_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'death_dt' => 'Death Date',
			'cause' => 'Cause of Death',
			'fname' => 'First Name',
			'lname' => 'Last Name',
			'age' => 'Age',
			'profession' => 'Profession',
			'buried_dt' => 'Buried Date',
			'minister' => 'Minister',
			'burial_place' => 'Burial Place',
			'ref_no' => 'Ref No',
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
		$criteria->compare('death_dt',$this->death_dt,true);
		$criteria->compare('cause',$this->cause,true);
		$criteria->compare('fname',$this->fname,true);
		$criteria->compare('lname',$this->lname,true);
		$criteria->compare('age',$this->age);
		$criteria->compare('profession',$this->profession,true);
		$criteria->compare('buried_dt',$this->buried_dt,true);
		$criteria->compare('minister',$this->minister,true);
		$criteria->compare('burial_place',$this->burial_place,true);
		$criteria->compare('ref_no',$this->ref_no,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function get_refno() {
		$recs = DeathRecord::model()->findAll(array(
			'condition'	=> 'year(death_dt)=year(:death_dt) and id<=:id',
			'params'	=> array(':death_dt' => $this->death_dt, ':id' => $this->id)
		));
		return date_format(new DateTime($this->death_dt), 'Y') . '/' . count($recs);
	}
}

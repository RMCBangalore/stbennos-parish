<?php

/**
 * This is the model class for table "baptisms".
 *
 * The followings are the available columns in table 'baptisms':
 * @property integer $id
 * @property string $dob
 * @property string $baptism_dt
 * @property string $name
 * @property integer $sex
 * @property string $fathers_name
 * @property string $mothers_name
 * @property string $residence
 * @property string $godfathers_name
 * @property string $godmothers_name
 * @property string $minister
 *
 * The followings are the available model relations:
 * @property BaptismCerts[] $baptismCerts
 */
class BaptismRecord extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return BaptismRecord the static model class
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
		return 'baptisms';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sex', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>50),
			array('fathers_name, mothers_name, godfathers_name, godmothers_name, minister', 'length', 'max'=>75),
			array('residence', 'length', 'max'=>25),
			array('dob, baptism_dt', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, dob, baptism_dt, name, sex, fathers_name, mothers_name, residence, godfathers_name, godmothers_name, minister', 'safe', 'on'=>'search'),
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
			'baptismCerts' => array(self::HAS_MANY, 'BaptismCerts', 'baptism_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'dob' => 'Dob',
			'baptism_dt' => 'Baptism Date',
			'name' => 'Name',
			'sex' => 'Sex',
			'fathers_name' => 'Fathers Name',
			'mothers_name' => 'Mothers Name',
			'residence' => 'Residence',
			'godfathers_name' => 'Godfathers Name',
			'godmothers_name' => 'Godmothers Name',
			'minister' => 'Minister',
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
		$criteria->compare('dob',$this->dob,true);
		$criteria->compare('baptism_dt',$this->baptism_dt,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('sex',$this->sex);
		$criteria->compare('fathers_name',$this->fathers_name,true);
		$criteria->compare('mothers_name',$this->mothers_name,true);
		$criteria->compare('residence',$this->residence,true);
		$criteria->compare('godfathers_name',$this->godfathers_name,true);
		$criteria->compare('godmothers_name',$this->godmothers_name,true);
		$criteria->compare('minister',$this->minister,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}

<?php

/**
 * This is the model class for table "mass_bookings".
 *
 * The followings are the available columns in table 'mass_bookings':
 * @property integer $id
 * @property integer $mass_id
 * @property string $booked_by
 * @property string $intention
 * @property integer $trans_id
 * @property string $mass_dt
 *
 * The followings are the available model relations:
 * @property Masses $mass
 * @property Transactions $trans
 */
class MassBooking extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MassBooking the static model class
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
		return 'mass_bookings';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('mass_id, trans_id', 'numerical', 'integerOnly'=>true),
			array('booked_by, intention', 'length', 'max'=>99),
			array('mass_dt', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, mass_id, booked_by, intention, trans_id, mass_dt', 'safe', 'on'=>'search'),
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
			'mass' => array(self::BELONGS_TO, 'MassSchedule', 'mass_id'),
			'trans' => array(self::BELONGS_TO, 'Transaction', 'trans_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'mass_id' => 'Mass',
			'booked_by' => 'Booked By',
			'intention' => 'Intention',
			'trans_id' => 'Trans',
			'mass_dt' => 'Mass Dt',
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
		$criteria->compare('mass_id',$this->mass_id);
		$criteria->compare('booked_by',$this->booked_by,true);
		$criteria->compare('intention',$this->intention,true);
		$criteria->compare('trans_id',$this->trans_id);
		$criteria->compare('mass_dt',$this->mass_dt,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}

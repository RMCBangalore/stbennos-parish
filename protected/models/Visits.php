<?php

/**
 * This is the model class for table "visits".
 *
 * The followings are the available columns in table 'visits':
 * @property integer $id
 * @property integer $pastor_id
 * @property string $visit_dt
 * @property integer $purpose
 * @property integer $family_id
 *
 * The followings are the available model relations:
 * @property Pastors $pastor
 * @property Families $family
 */
class Visits extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Visits the static model class
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
		return 'visits';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('family_id', 'required'),
			array('pastor_id, purpose, family_id', 'numerical', 'integerOnly'=>true),
			array('visit_dt', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, pastor_id, visit_dt, purpose, family_id', 'safe', 'on'=>'search'),
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
			'pastor' => array(self::BELONGS_TO, 'Pastors', 'pastor_id'),
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
			'pastor_id' => 'Pastor',
			'visit_dt' => 'Visit Dt',
			'purpose' => 'Purpose',
			'family_id' => 'Family',
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
		$criteria->compare('pastor_id',$this->pastor_id);
		$criteria->compare('visit_dt',$this->visit_dt,true);
		$criteria->compare('purpose',$this->purpose);
		$criteria->compare('family_id',$this->family_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
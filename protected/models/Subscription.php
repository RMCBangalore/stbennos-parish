<?php

/**
 * This is the model class for table "subscriptions".
 *
 * The followings are the available columns in table 'subscriptions':
 * @property integer $id
 * @property integer $family_id
 * @property integer $trans_id
 * @property integer $year
 * @property integer $month
 *
 * The followings are the available model relations:
 * @property Families $family
 * @property Transactions $trans
 */
class Subscription extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Subscription the static model class
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
		return 'subscriptions';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('family_id, trans_id, year, month', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, family_id, trans_id, year, month', 'safe', 'on'=>'search'),
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
			'family' => array(self::BELONGS_TO, 'Families', 'family_id'),
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
			'family_id' => 'Family',
			'trans_id' => 'Trans',
			'year' => 'Year',
			'month' => 'Month',
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
		$criteria->compare('family_id',$this->family_id);
		$criteria->compare('trans_id',$this->trans_id);
		$criteria->compare('month',$this->month,true);
		$criteria->compare('year',$this->year,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}

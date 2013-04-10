<?php

/**
 * This is the model class for table "first_communion_certs".
 *
 * The followings are the available columns in table 'first_communion_certs':
 * @property integer $id
 * @property string $cert_dt
 * @property integer $first_comm_id
 *
 * The followings are the available model relations:
 * @property FirstCommunions $firstComm
 */
class FirstCommunionCertificate extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return FirstCommunionCertificate the static model class
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
		return 'first_communion_certs';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('first_comm_id', 'numerical', 'integerOnly'=>true),
			array('cert_dt', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, cert_dt, first_comm_id', 'safe', 'on'=>'search'),
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
			'firstComm' => array(self::BELONGS_TO, 'FirstCommunions', 'first_comm_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'cert_dt' => 'Cert Dt',
			'first_comm_id' => 'First Comm',
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
		$criteria->compare('cert_dt',$this->cert_dt,true);
		$criteria->compare('first_comm_id',$this->first_comm_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
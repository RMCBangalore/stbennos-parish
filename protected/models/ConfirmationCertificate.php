<?php

/**
 * This is the model class for table "confirmation_certs".
 *
 * The followings are the available columns in table 'confirmation_certs':
 * @property integer $id
 * @property string $cert_dt
 * @property integer $confirmation_id
 *
 * The followings are the available model relations:
 * @property Confirmations $confirmation
 */
class ConfirmationCertificate extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ConfirmationCertificate the static model class
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
		return 'confirmation_certs';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('confirmation_id', 'numerical', 'integerOnly'=>true),
			array('cert_dt', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, cert_dt, confirmation_id', 'safe', 'on'=>'search'),
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
			'confirmation' => array(self::BELONGS_TO, 'ConfirmationRecord', 'confirmation_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'cert_dt' => 'Certificate Date',
			'confirmation_id' => 'Confirmation',
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
		$criteria->compare('confirmation_id',$this->confirmation_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}

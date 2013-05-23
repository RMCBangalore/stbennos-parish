<?php

/**
 * This is the model class for table "membership_certs".
 *
 * The followings are the available columns in table 'membership_certs':
 * @property integer $id
 * @property integer $member_id
 * @property string $cert_dt
 */
class MembershipCertificate extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MembershipCertificate the static model class
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
		return 'membership_certs';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('member_id', 'numerical', 'integerOnly'=>true),
			array('cert_dt', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, member_id, cert_dt', 'safe', 'on'=>'search'),
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
			'member' => array(self::BELONGS_TO, 'People', 'member_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'member_id' => 'Member',
			'cert_dt' => 'Cert Dt',
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
		$criteria->compare('member_id',$this->member_id);
		$criteria->compare('cert_dt',$this->cert_dt,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}

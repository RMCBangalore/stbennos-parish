<?php

/**
 * This is the model class for table "field_names".
 *
 * The followings are the available columns in table 'field_names':
 * @property integer $id
 * @property string $name
 *
 * The followings are the available model relations:
 * @property FieldValues[] $fieldValues
 */
class FieldNames extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return FieldNames the static model class
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
		return 'field_names';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required'),
			array('name', 'length', 'max'=>25),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name', 'safe', 'on'=>'search'),
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
			'fieldValues' => array(self::HAS_MANY, 'FieldValues', 'field_id'),
		);
	}

    public static function values($name) {
        $model = self::model()->find(array(
            'condition' => 'name=:name',
            'params'    => array(':name' => $name)
        ));
		foreach($model->fieldValues as $fv) {
			$table[$fv->code] = $fv->name;
		}
		return $table;
    }
	
	public static function value($name, $code) {
		if (!isset($code)) {
			return null;
		}
		$fv = FieldNames::values($name);
		return $fv[$code];
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
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
		$criteria->compare('name',$this->name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}

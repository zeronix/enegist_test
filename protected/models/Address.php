<?php

/**
 * This is the model class for table "address".
 *
 * The followings are the available columns in table 'address':
 * @property string $id
 * @property string $address_type_id
 * @property string $profile_id
 * @property string $address1
 * @property string $address2
 * @property string $city
 * @property string $country
 * @property string $zip_code
 *
 * The followings are the available model relations:
 * @property AddressType $addressType
 * @property Profile $profile
 */
class Address extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'address';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('address_type_id, profile_id, address1, city, country, zip_code', 'required'),
			array('address_type_id, profile_id', 'length', 'max'=>10),
			array('address1, address2', 'length', 'max'=>100),
			array('city, country', 'length', 'max'=>30),
			array('zip_code', 'length', 'max'=>5),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, address_type_id, profile_id, address1, address2, city, country, zip_code', 'safe', 'on'=>'search'),
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
			'addressType' => array(self::BELONGS_TO, 'AddressType', 'address_type_id'),
			'profile' => array(self::BELONGS_TO, 'Profile', 'profile_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'address_type_id' => 'Address Type',
			'profile_id' => 'Profile',
			'address1' => 'Address1',
			'address2' => 'Address2',
			'city' => 'City',
			'country' => 'Country',
			'zip_code' => 'Zip Code',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('address_type_id',$this->address_type_id,true);
		$criteria->compare('profile_id',$this->profile_id,true);
		$criteria->compare('address1',$this->address1,true);
		$criteria->compare('address2',$this->address2,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('country',$this->country,true);
		$criteria->compare('zip_code',$this->zip_code,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Address the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

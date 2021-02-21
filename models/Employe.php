<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "employe".
 *
 * @property int $id
 * @property string $lastname
 * @property string|null $firstname
 * @property string|null $address
 * @property string|null $country_of_origin
 * @property string $email
 * @property string $phone_number
 * @property int $age
 * @property int|null $hired
 * @property int|null $updated
 * @property int $created
 */
class Employe extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'employe';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['lastname', 'email', 'phone_number', 'age'], 'required'],
            [['age', 'hired', 'updated', 'created','employe_status_id','user_id'], 'integer'],
            ['email', 'email'],
            [['email'], 'unique'],
            [['lastname', 'firstname', 'address', 'country_of_origin', 'email', 'phone_number'], 'string', 'max' => 255],
            [['firstname','lastname','email'], 'string', 'min' => 5],
            [['address'], 'string', 'min' => 10],
       
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'lastname' => Yii::t('app', 'Lastname'),
            'firstname' => Yii::t('app', 'Firstname'),
            'address' => Yii::t('app', 'Address'),
            'country_of_origin' => Yii::t('app', 'Country Of Origin'),
            'email' => Yii::t('app', 'Email Address'),
            'phone_number' => Yii::t('app', 'Phone Number'),
            'age' => Yii::t('app', 'Age'),
            'employe_status_id' => Yii::t('app', 'Employe status'),
            'user_id' => Yii::t('app', 'User'),
            'hired' => Yii::t('app', 'Hired'),
            'updated' => Yii::t('app', 'Updated'),
            'created' => Yii::t('app', 'Created'),
        ];
    }

    public function beforeSave($insert)
    {
        if ($this->isNewRecord) {
            $this->created = time();
            $this->updated = time();
            $this->employe_status_id = 1;
            $this->hired = false;
        }
        return parent::beforeSave($insert);
    }

    public function getStatus()
    {
        $model = EmployeStatus::findOne($this->employe_status_id);
        switch ($model->id) {
            case '1': 
                $data = '<span class="label label-inline font-weight-bolder label-light-primary" style="font-size:1.25rem;">'.$model->name.'</span>';
                break;
            case '2':
                $data = '<span class="label label-inline font-weight-bolder label-light-info" style="font-size:1.25rem;">'.$model->name.'</span>';
                break;
            case '3':
                $data = '<span class="label label-inline font-weight-bolder label-light-success" style="font-size:1.25rem;">'.$model->name.'</span>';
                break;
            case '4':
                $data = '<span class="label label-inline font-weight-bolder label-light-danger" style="font-size:1.25rem;">'.$model->name.'</span>';
                break;

            default:
               $data = '<span class="label label-inline font-weight-bolder label-light-warning" style="font-size:1.25rem;">Status not fount</span>';
                break;
        }
        return $data; 
    }

    public static function getList()
    {
        $model = EmployeStatus::find()->asArray()->all();
        return ArrayHelper::map($model, 'id', 'name');
    }


    public static function getListModal()
    {
        $model = EmployeStatus::find()->all();
        return $model;
    }

    public function getStatusName()
    {
        return $this->hasOne(EmployeStatus::className(), ['id' => 'employe_status_id']);
    }
}

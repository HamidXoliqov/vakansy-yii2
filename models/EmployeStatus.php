<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "employe_status".
 *
 * @property int $id
 * @property string $name
 * @property int|null $updated
 * @property int $created
 */
class EmployeStatus extends \yii\db\ActiveRecord
{
    const EMPLOYE_STATUS_NEW = 1;
    const EMPLOYE_STATUS_PENDING = 2;
    const EMPLOYE_STATUS_SUCCESS = 3;
    const EMPLOYE_STATUS_INACTIVE = 5;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'employe_status';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['updated', 'created'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'updated' => Yii::t('app', 'Updated'),
            'created' => Yii::t('app', 'Created'),
        ];
    }
    public function beforeSave($insert)
    {
        if ($this->isNewRecord) {
            $this->created = time();
            $this->updated = time();
        }
        return parent::beforeSave($insert);
    }
}

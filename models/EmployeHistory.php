<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "employe_history".
 *
 * @property int $id
 * @property int|null $employe_id
 * @property int $employe_status_id
 * @property string|null $comment
 * @property int|null $create_at
 *
 * @property Employe $employe
 */
class EmployeHistory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'employe_history';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['employe_id', 'employe_status_id', 'create_at'], 'integer'],
            [['employe_status_id'], 'required'],
            [['comment'], 'string'],
            [['employe_id'], 'exist', 'skipOnError' => true, 'targetClass' => Employe::className(), 'targetAttribute' => ['employe_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'employe_id' => Yii::t('app', 'Employe ID'),
            'employe_status_id' => Yii::t('app', 'Employe Status ID'),
            'comment' => Yii::t('app', 'Comment'),
            'create_at' => Yii::t('app', 'Create At'),
        ];
    }

    /**
     * Gets query for [[Employe]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmploye()
    {
        return $this->hasOne(Employe::className(), ['id' => 'employe_id']);
    }

    /**
     * Gets query for [[EmployeStatus]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(EmployeStatus::className(), ['id' => 'employe_status_id']);
    }
}

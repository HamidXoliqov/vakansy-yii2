<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $firstname
 * @property string|null $lastname
 * @property string $email
 * @property string $password
 * @property string $role
 * @property int|null $status
 * @property int|null $updated
 * @property int $created
 */
class User extends ActiveRecord implements \yii\web\IdentityInterface
{
    public $confirm_password;
    const ACTIVE_USER = 1;
    const IN_ACTIVE_USER = 0;
    const DELETE_USER = 9;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['firstname', 'email', 'password'], 'required'],
            [['status', 'updated', 'created'], 'integer'],
            [['firstname', 'lastname', 'email', 'password', 'role', 'auth_key', 'password_reset_token'], 'string', 'max' => 255],
            ['email','email'],
            [['email'], 'unique'],
            [['firstname','lastname','email'], 'string', 'min' => 5],
            ['password', 'string', 'min' => 8],

            ['confirm_password', 'compare', 'compareAttribute' => 'password'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'firstname' => Yii::t('app', 'Firstname'),
            'lastname' => Yii::t('app', 'Lastname'),
            'email' => Yii::t('app', 'Email'),
            'password' => Yii::t('app', 'Password'),
            'role' => Yii::t('app', 'Role'),
            'status' => Yii::t('app', 'Status'),
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

    public function setPassword($password)
    {
       $this->password = Yii::$app->security->generatePasswordHash($password);
    }

    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }

    public function getId()
    {
        return $this->getPrimaryKey();
    }

    public static function findIdentity($id)
    {
        return self::findOne($id);
    }

    public static function findByEmail($email)
    {
       return self::findOne(['email' => $email, 'status' => self::ACTIVE_USER]);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    public function getAuthKey()
    {
        return $this->authKey;
    }

    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }
}

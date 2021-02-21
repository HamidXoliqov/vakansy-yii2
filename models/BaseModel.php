<?php
namespace app\models;

use app\components\behaviors\CommonBehavior;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

class BaseModel extends ActiveRecord
{
    const STATUS_ACTIVE             = 1;
    const STATUS_INACTIVE           = 2;
    const STATUS_SAVED              = 3;
    const STATUS_DELETED            = 4;
    const STATUS_PENDING            = 5;
    const STATUS_DRAFT              = 6;
    const STATUS_FINAL              = 7;

    const IS_TRANSFER_RESIVING      = 1;
    const IS_TRANSFER_OUTPUTING     = 0;

    //TOKEN LIST
    const TOKEN_REFERENCE_CURRENCY = 'CURRENCY';

    public $cp = [];

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                // if you're using datetime instead of UNIX timestamp:
                // 'value' => new Expression('NOW()'),
            ],
            [
                'class' => CommonBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_by', 'updated_by'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_by'],
                ],

            ],
        ];
    }
    //Oma funksiya nomini yirtib qoyibdi kim yozgan bolsa ham )
    public function getfaol($status_id)
    {
        $faol=[ 1 => "Faol", 2 => 'Faol emas'];
        return $faol[$status_id];
    }

    public static function getRequirementForLabel($title = '', $data = '', $type = 'right')
    {
        $title = (strlen($data) > 0) ? 'title="' . Yii::t('app', $title) . '"' : 'data-content="' . Yii::t('app', $title) . '"';
        $data =  (strlen($data) > 0) ? 'data-content="' . Yii::t('app', $data) . '"' : '';
        $type = 'data-placement="' . $type . '"';
        
        return ' <i '. $title . $data . $type .' style="cursor: help; color:#228dff" class="la la-info-circle" data-toggle="popover" data-html="true"></i>';
    }

    /**
     * @param null $id
     * @return array|mixed
     */
    public static function getStatusList($id = null){
        $statusList = [
            self::STATUS_ACTIVE => Yii::t('app','Active'),
            self::STATUS_INACTIVE => Yii::t('app','Inactive'),
            self::STATUS_SAVED => Yii::t('app','Saved'),
            self::STATUS_DELETED => Yii::t('app','Deleted'),
            self::STATUS_PENDING => Yii::t('app','Pending'),
            self::STATUS_DRAFT => Yii::t('app','Draft'),
            self::STATUS_FINAL => Yii::t('app','Final'),
        ];
        if(!empty($id) && array_key_exists($id, $statusList)) return $statusList[$id];
        return $statusList;
    }
}
<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace app\models\query\base;

use Yii;

/**
 * This is the base-model class for table "staff_events".
 *
 * @property integer $id
 * @property integer $customer_id
 * @property integer $staff_id
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 * @property integer $event_id
 *
 * @property \app\models\query\Customer $customer
 * @property string $aliasModel
 */
abstract class StaffEvent extends \yii\db\ActiveRecord
{



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'staff_events';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_id', 'staff_id', 'status', 'event_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => \app\models\query\Customer::className(), 'targetAttribute' => ['customer_id' => 'id']]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('models', 'ID'),
            'customer_id' => Yii::t('models', 'Customer ID'),
            'staff_id' => Yii::t('models', 'Staff ID'),
            'status' => Yii::t('models', 'Status'),
            'created_at' => Yii::t('models', 'Created At'),
            'updated_at' => Yii::t('models', 'Updated At'),
            'event_id' => Yii::t('models', 'Event ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(\app\models\query\Customer::className(), ['id' => 'customer_id']);
    }


    
    /**
     * @inheritdoc
     * @return \app\models\StaffEventQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\StaffEventQuery(get_called_class());
    }


}
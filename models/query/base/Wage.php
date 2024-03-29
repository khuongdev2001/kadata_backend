<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace app\models\query\base;

use Yii;

/**
 * This is the base-model class for table "wages".
 *
 * @property integer $id
 * @property integer $customer_id
 * @property integer $staff_id
 * @property integer $basic_pay
 * @property integer $piece_pay
 * @property integer $allowance_pay
 * @property integer $total_pay
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 *
 * @property \app\models\query\Customer $customer
 * @property \app\models\query\Staff $staff
 * @property string $aliasModel
 */
abstract class Wage extends \yii\db\ActiveRecord
{
    const STATUS_PENDING = 0;
    const STATUS_TRANSFER = 1;
    const STATUS_CASH = 2;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wages';
    }

    public function getStatus($key = null)
    {
        $status = [self::STATUS_PENDING, self::STATUS_TRANSFER, self::STATUS_CASH];
        if ($key) {
            return $status[$key];
        }
        return $status;
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_id', 'staff_id'], 'required'],
            [['customer_id', 'staff_id', 'basic_pay', 'piece_pay', 'allowance_pay', 'total_pay', 'status'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => \app\models\query\Customer::className(), 'targetAttribute' => ['customer_id' => 'id']],
            [['staff_id'], 'exist', 'skipOnError' => true, 'targetClass' => \app\models\query\Staff::className(), 'targetAttribute' => ['staff_id' => 'id']]
        ];
    }

    /**
     * @inheritdoc
     */
//    public function attributeLabels()
//    {
//        return [
//            'id' => Yii::t('models', 'ID'),
//            'customer_id' => Yii::t('models', 'Customer ID'),
//            'staff_id' => Yii::t('models', 'Staff ID'),
//            'basic_pay' => Yii::t('models', 'Basic Pay'),
//            'piece_pay' => Yii::t('models', 'Piece Pay'),
//            'allowance_pay' => Yii::t('models', 'Allowance Pay'),
//            'total_pay' => Yii::t('models', 'Total Pay'),
//            'status' => Yii::t('models', 'Status'),
//            'created_at' => Yii::t('models', 'Created At'),
//            'updated_at' => Yii::t('models', 'Updated At'),
//        ];
//    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(\app\models\query\Customer::className(), ['id' => 'customer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStaff()
    {
        return $this->hasOne(\app\models\query\Staff::className(), ['id' => 'staff_id']);
    }


    /**
     * @inheritdoc
     * @return \app\models\WageQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\WageQuery(get_called_class());
    }

    public function getStatusText()
    {
        return [
            self::STATUS_PENDING => "Đã tính lương",
            self::STATUS_TRANSFER => "Đã chuyển khoản",
            self::STATUS_CASH => "Đã chuyển tiền mặt"
        ][$this->status];
    }

}

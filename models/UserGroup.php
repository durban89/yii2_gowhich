<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_user_group".
 *
 * @property integer $id
 * @property string $name
 * @property string $mark
 * @property string $descr
 * @property string $create_datetime
 * @property string $update_datetime
 * @property integer $is_deleted
 */
class UserGroup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_user_group';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'mark', 'descr', 'create_datetime', 'update_datetime'], 'required'],
            [['descr'], 'string'],
            [['create_datetime', 'update_datetime'], 'safe'],
            [['is_deleted'], 'integer'],
            [['name', 'mark'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'mark' => 'Mark',
            'descr' => 'Descr',
            'create_datetime' => 'Create Datetime',
            'update_datetime' => 'Update Datetime',
            'is_deleted' => 'Is Deleted',
        ];
    }
}

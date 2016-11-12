<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_type".
 *
 * @property integer $id
 * @property string $name
 * @property string $screen_name
 * @property string $category
 * @property integer $is_delete
 * @property integer $is_lock
 * @property string $create_date
 * @property string $update_date
 */
class Type extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'screen_name', 'create_date'], 'required'],
            [['category'], 'string'],
            [['is_delete', 'is_lock'], 'integer'],
            [['create_date', 'update_date'], 'safe'],
            [['name'], 'string', 'max' => 128],
            [['screen_name'], 'string', 'max' => 255],
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
            'screen_name' => 'Screen Name',
            'category' => 'Category',
            'is_delete' => 'Is Delete',
            'is_lock' => 'Is Lock',
            'create_date' => 'Create Date',
            'update_date' => 'Update Date',
        ];
    }
}

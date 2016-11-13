<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_file".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $url_address
 * @property integer $download_sum
 * @property integer $category_id
 * @property integer $is_delete
 * @property integer $is_lock
 * @property string $create_date
 * @property string $update_date
 */
class File extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_file';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'url_address', 'category_id', 'create_date'], 'required'],
            [['description'], 'string'],
            [['download_sum', 'category_id', 'is_delete', 'is_lock'], 'integer'],
            [['create_date', 'update_date'], 'safe'],
            [['title', 'url_address'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'url_address' => 'Url Address',
            'download_sum' => 'Download Sum',
            'category_id' => 'Category ID',
            'is_delete' => 'Is Delete',
            'is_lock' => 'Is Lock',
            'create_date' => 'Create Date',
            'update_date' => 'Update Date',
        ];
    }
}

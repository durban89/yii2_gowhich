<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_blog_category".
 *
 * @property integer $id
 * @property string $name
 * @property string $descr
 * @property integer $is_deleted
 * @property integer $ctime
 * @property integer $mtime
 */
class BlogCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_blog_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['is_deleted', 'ctime', 'mtime'], 'integer'],
            [['name'], 'string', 'max' => 100],
            [['descr'], 'string', 'max' => 255],
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
            'descr' => 'Descr',
            'is_deleted' => 'Is Deleted',
            'ctime' => 'Ctime',
            'mtime' => 'Mtime',
        ];
    }
}

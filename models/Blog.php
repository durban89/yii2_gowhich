<?php

namespace app\models;

use app\models\Type;
use app\models\User;
use Yii;

/**
 * This is the model class for table "tbl_blog".
 *
 * @property integer $id
 * @property string $title
 * @property string $path
 * @property string $author
 * @property string $description
 * @property integer $read_sum
 * @property string $tag
 * @property string $source_url
 * @property integer $type_id
 * @property integer $user_id
 * @property integer $is_lock
 * @property integer $is_delete
 * @property integer $isopen
 * @property integer $isrec
 * @property integer $isreprinted
 * @property string $create_date
 * @property string $update_date
 */
class Blog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_blog';
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getCategory()
    {
        return $this->hasOne(Type::className(), ['id' => 'type_id']);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'path', 'author', 'description', 'user_id', 'isopen', 'isrec', 'isreprinted', 'create_date'], 'required'],
            [['description', 'tag'], 'string'],
            [['read_sum', 'type_id', 'user_id', 'is_lock', 'is_delete', 'isopen', 'isrec', 'isreprinted'], 'integer'],
            [['create_date', 'update_date'], 'safe'],
            [['title', 'source_url'], 'string', 'max' => 255],
            [['path', 'author'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'          => 'ID',
            'title'       => 'Title',
            'path'        => 'Path',
            'author'      => 'Author',
            'description' => 'Description',
            'read_sum'    => 'Read Sum',
            'tag'         => 'Tag',
            'source_url'  => 'Source Url',
            'type_id'     => 'Type ID',
            'user_id'     => 'User ID',
            'is_lock'     => 'Is Lock',
            'is_delete'   => 'Is Delete',
            'isopen'      => 'Isopen',
            'isrec'       => 'Isrec',
            'isreprinted' => 'Isreprinted',
            'create_date' => 'Create Date',
            'update_date' => 'Update Date',
        ];
    }
}

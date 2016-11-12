<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_user".
 *
 * @property integer $id
 * @property string $username
 * @property string $firstname
 * @property string $lastname
 * @property string $password
 * @property integer $role_id
 * @property integer $group_id
 * @property string $email
 * @property string $qq
 * @property string $sex
 * @property string $phone
 * @property string $weibo
 * @property string $profile
 * @property string $notes
 * @property string $company
 * @property string $website
 * @property string $address
 * @property string $city
 * @property string $state
 * @property string $postcode
 * @property string $login_ip
 * @property integer $login_time
 * @property string $login_date
 * @property integer $is_delete
 * @property integer $is_lock
 * @property string $create_date
 * @property string $update_date
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'firstname', 'lastname', 'password', 'role_id', 'group_id', 'email', 'notes', 'company', 'website', 'address', 'city', 'state', 'postcode', 'create_date'], 'required'],
            [['role_id', 'group_id', 'login_time', 'is_delete', 'is_lock'], 'integer'],
            [['profile', 'notes'], 'string'],
            [['login_date', 'create_date', 'update_date'], 'safe'],
            [['username', 'password', 'email'], 'string', 'max' => 128],
            [['firstname', 'lastname', 'website', 'address', 'city', 'state', 'postcode'], 'string', 'max' => 200],
            [['qq', 'sex', 'phone', 'weibo', 'login_ip'], 'string', 'max' => 100],
            [['company'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'firstname' => 'Firstname',
            'lastname' => 'Lastname',
            'password' => 'Password',
            'role_id' => 'Role ID',
            'group_id' => 'Group ID',
            'email' => 'Email',
            'qq' => 'Qq',
            'sex' => 'Sex',
            'phone' => 'Phone',
            'weibo' => 'Weibo',
            'profile' => 'Profile',
            'notes' => 'Notes',
            'company' => 'Company',
            'website' => 'Website',
            'address' => 'Address',
            'city' => 'City',
            'state' => 'State',
            'postcode' => 'Postcode',
            'login_ip' => 'Login Ip',
            'login_time' => 'Login Time',
            'login_date' => 'Login Date',
            'is_delete' => 'Is Delete',
            'is_lock' => 'Is Lock',
            'create_date' => 'Create Date',
            'update_date' => 'Update Date',
        ];
    }
}

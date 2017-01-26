<?php

namespace app\models\base;

use Yii;

/**
 * This is the model class for table "admin".
 *
 * @property integer $id
 * @property string $username
 * @property string $fullname
 * @property string $password
 * @property integer $id_role
 * @property string $authKey
 * @property string $accessToken
 * @property string $last_login
 * @property string $last_logout
 * @property string $foto_url
 */
class Admin extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'admin';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'fullname', 'password', 'id_role'], 'required'],
            [['id_role'], 'integer'],
            [['last_login', 'last_logout'], 'safe'],
            [['username', 'password'], 'string', 'max' => 30],
            [['fullname', 'authKey', 'accessToken'], 'string', 'max' => 50],
            [['foto_url'], 'string', 'max' => 100],
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
            'fullname' => 'Fullname',
            'password' => 'Password',
            'id_role' => 'Id Role',
            'authKey' => 'Auth Key',
            'accessToken' => 'Access Token',
            'last_login' => 'Last Login',
            'last_logout' => 'Last Logout',
            'foto_url' => 'Foto Url',
        ];
    }

    public function getRole(){
        return $this->hasOne(\app\models\Role::className(), ['id' => 'id_role']);
    }
}

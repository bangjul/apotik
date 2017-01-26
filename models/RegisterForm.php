<?php
namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\Expression;


class RegisterForm extends Model
{
    public $fullname;
    public $username;
    public $password;
    public $rememberMe = true;
    private $id_role = 1; //Super Admin

    public function rules()
    {
        return [
            // username and password are both required
            [['fullname','username', 'password'], 'required']
        ];
    }

    public function register() {
        if ($this->validate()) {
            $user = new User();
            $user->username = $this->username;
            $user->password = $this->password;
            $user->fullname = $this->fullname;
            $user->id_role = $this->id_role;
//            $user->foto_url = '';
//            $user->authKey = '';
//            $user->accessToken = '';
            $user->last_login = new Expression("NOW()");
            $user->last_logout = new Expression("NOW()");

            if ($user->save()) {
                return true;
            } else {
                if ($user->errors) {
                    $this->addErrors($user->errors);
                }
                return false;
            }
        }
        return false;
    }
}

<?php

namespace app\models\services;

use app\models\services\db\UserDB;
use app\models\services\db\BaseDB;
use Twig\Cache\NullCache;

/**
 * Created by IntelliJ IDEA.
 * User: sayaka
 * Date: 2017/08/29
 * Time: 21:27
 */
class UserService {
    public function createUser($user_name, $password) {
        UserDB::insert($user_name, $password);
    }

    public function verify($user_name) {
        $row = UserDB::selectUser($user_name);
        return empty($row);
    }

    public function identify($user_name, $password) {
        $row = UserDB::selectUser($user_name);
        if (!empty($row)) {
            $pass = $row["password"];
            if (password_verify($password, $pass)) {
                return $row["user_name"];
            }
        }
        return null;
    }
    
}
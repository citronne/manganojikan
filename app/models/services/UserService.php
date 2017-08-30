<?php

namespace app\models\services;

use app\models\services\db\UserDB;
/**
 * Created by IntelliJ IDEA.
 * User: sayaka
 * Date: 2017/08/29
 * Time: 21:27
 */
class UserService {
    public static function createUser($password, $user) {
        
        } else {
            return $password;
        }

    }
    
    public static function identify() {
        $id = $_POST["id"];
        $pass = $_POST["password"];
        $row = UserDB::select();
        while ($row) {
            $user_name = $row["user_name"];
            $password = $row["id_library"];
            if(strcmp($id, $user_name)&& strcmp($pass, $password)) {
                
            }
         }

    }
}
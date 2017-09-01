<?php

namespace app\models\services;

use app\models\services\db\UserDB;
use app\models\services\db\BaseDB;
/**
 * Created by IntelliJ IDEA.
 * User: sayaka
 * Date: 2017/08/29
 * Time: 21:27
 */
class UserService {
    public function createUser($user_name, $password) {
        UserDB::insert($user_name, $password);
        echo "Création réussite";
    }

    public static function verify($user_name) {
        $link = BaseDB::connect();
        $user_name = mysqli_real_escape_string($link, $user_name);
        $sql = "SELECT user_name FROM user WHERE user_name = '$user_name'";
        $res = mysqli_query($link, $sql) or die("Invalid query") . mysqli_error($link);
        $row = mysqli_fetch_assoc($res);
        mysqli_close($link);
        return $row;
    }
    
    public function identify($id, $pass) {
        $row = UserDB::select();
        while ($row) {
            $user_name = $row["user_name"];
            $password = $row["id_library"];
            if(strcmp($id, $user_name)&& strcmp($pass, $password)) {
                
            }
         }

    }
    
}
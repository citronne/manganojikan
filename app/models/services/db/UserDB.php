<?php
/**
 * Created by IntelliJ IDEA.
 * User: sayaka
 * Date: 2017/08/27
 * Time: 19:54
 */

namespace app\models\services\db;


class UserDB {
    public static function insert($user_name, $password) {
        $link = BaseDB::connect();
        $user_name = mysqli_real_escape_string($link, $user_name);
        $password = mysqli_real_escape_string($link, $password);
        $pass = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO USER (id, user_name, password) VALUES (NULL, '$user_name', '$pass')";
        mysqli_query($link, $sql) or die("Invalid query") . mysqli_error($link);
        mysqli_close($link);
    }
    
    public static function select() {
        $link = BaseDB::connect();
        $sql = "SELECT * FROM user";
        $res = mysqli_query($link, $sql) or die("Invalid query") . mysqli_error($link);
        $row = mysqli_fetch_assoc($res);
        mysqli_close($link);
        return $row;
    }
    
}
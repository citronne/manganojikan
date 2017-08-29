<?php
/**
 * Created by IntelliJ IDEA.
 * User: sayaka
 * Date: 2017/08/27
 * Time: 19:54
 */

namespace app\models\services\db;


class UserDB {
    public static function createUser() {


        if ($password != $password2) {
            
        }
        $link = BaseDB::connect();
    }

    public static function insert($volume) {
        $link = BaseDB::connect();
        $path = mysqli_real_escape_string($link, $user->getPath());
        $sql = "INSERT INTO library (id, path) VALUES (NULL, '$path')";
        mysqli_query($link, $sql) or die("Invalid query") . mysqli_error($link);
        $library->setId(mysqli_insert_id($link));
        mysqli_close($link);
    }
    
}
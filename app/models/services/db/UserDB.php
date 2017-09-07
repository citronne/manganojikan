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
        $sql = "INSERT INTO USER (id, user_name, password, id_library) VALUES (NULL, '$user_name', '$pass', NULL)";
        mysqli_query($link, $sql) or die("Invalid query") . mysqli_error($link);
        mysqli_close($link);
    }

    public static function insertIdLibrary($id_user, $id_library) {
        $link = BaseDB::connect();
        $sql = "UPDATE USER SET id_library = $id_library WHERE id = $id_user";
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

    public static function selectUser($user_name) {
        $link = BaseDB::connect();
        $user_name = mysqli_real_escape_string($link, $user_name);
        $sql = "SELECT id, user_name, password FROM user WHERE user_name = '$user_name'";
        $res = mysqli_query($link, $sql) or die("Invalid query") . mysqli_error($link);
        $row = mysqli_fetch_assoc($res);
        mysqli_close($link);
        return $row;
    }

    public function selectLibrary($id_user) {
        $link = BaseDB::connect();
        $sql = "SELECT id_library FROM user WHERE id = $id_user";
        $res = mysqli_query($link, $sql) or die("Invalid query") . mysqli_error($link);
        $row = mysqli_fetch_assoc($res);
        mysqli_close($link);
        return $row;
    }
}
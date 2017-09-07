<?php

namespace app\models\services\db;

/**
 * Created by IntelliJ IDEA.
 * User: sayaka
 * Date: 2017/08/20
 * Time: 16:24
 */
class LibraryDB {
    public static function insert($library) {
        $link = BaseDB::connect();
        $path = mysqli_real_escape_string($link, $library->getPath());
        $sql = "INSERT INTO library (id, path) VALUES (NULL, '$path')";
        mysqli_query($link, $sql) or die("Invalid query") . mysqli_error($link);
        $library->setId(mysqli_insert_id($link));
        mysqli_close($link);
    }

    public static function select($id_library) {
        $link = BaseDB::connect();
        $sql = "SELECT * FROM library WHERE id = $id_library";
        $res = mysqli_query($link, $sql) or die("Invalid query") . mysqli_error($link);
        $row = mysqli_fetch_assoc($res);
        mysqli_close($link);
        return $row;
    }

    public static function selectByUserId($id_user) {
        $link = BaseDB::connect();
        $sql = "SELECT l.id, l.path FROM library l INNER JOIN user u  ON l.id = u.id_library WHERE u.id = $id_user";
        $res = mysqli_query($link, $sql) or die("Invalid query") . mysqli_error($link);
        $row = mysqli_fetch_assoc($res);
        mysqli_close($link);
        return $row;
    }
}
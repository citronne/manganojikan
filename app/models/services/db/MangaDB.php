<?php

namespace app\models\services\db;

/**
 * Created by IntelliJ IDEA.
 * User: sayaka
 * Date: 2017/08/20
 * Time: 16:26
 */


class MangaDB {
    public static function insert($library, $manga) {
        $link = BaseDB::connect();
        $library_id = $library->getId();
        $name = $manga->getName();
        $sql = "INSERT INTO manga(id, id_library, name) VALUES (NULL, '$library_id', '$name')" ;
        mysqli_query($link, $sql) or die("Invalid query") . mysqli_error($link);
        $manga->setId(mysqli_insert_id($link));
        mysqli_close($link);
    }

    public static function select() {
        $link = BaseDB::connect();
        $sql = "SELECT * FROM manga";
        $res = mysqli_query($link, $sql) or die("Invalid query") . mysqli_error($link);
        return $row = mysqli_fetch_assoc($res);
        mysqli_close($link);
    }
}
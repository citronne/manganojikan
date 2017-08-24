<?php
/**
 * Created by IntelliJ IDEA.
 * User: sayaka
 * Date: 2017/08/21
 * Time: 22:11
 */

namespace app\models\services\db;


class VolumeDB {
    public static function insert($manga, $volume) {
        $link = BaseDB::connect();
        $manga_id = $manga->getID();
        $volume_number = $volume->getVolumeNumber();
        $path = $volume->getPath();
        $sql = "INSERT INTO volume(id, id_manga, volume_number, path, add_date, access_date, read_status, page_number) VALUES (NULL, '$manga_id', '$volume_number', '$path', NOW(), NULL, 0, 0)";
        $res = mysqli_query($link, $sql) or die("Invalid query") . mysqli_error($link);
        $volume->setId(mysqli_insert_id($link));
        mysqli_close($link);
    }

    public static function select() {
        $link = BaseDB::connect();
        $sql = "SELECT * FROM volume";
        $res = mysqli_query($link, $sql) or die("Invalid query") . mysqli_error($link);
        return $row = mysqli_fetch_assoc($res);
        mysqli_close($link);
    }

}
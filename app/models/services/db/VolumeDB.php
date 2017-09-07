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
        $volume_number = mysqli_real_escape_string($link, $volume->getVolumeNumber());
        $path = mysqli_real_escape_string($link, $volume->getPath());
        $file_names = mysqli_real_escape_string($link, implode(",", $volume->getFileNames()));

        $sql = "INSERT INTO volume(id, id_manga, volume_number, path, add_date, access_date, read_status, page_number, file_names)
                VALUES (NULL, '$manga_id', '$volume_number', '$path', NOW(), NULL, 0, 0, '$file_names')";
        $res = mysqli_query($link, $sql) or die("Invalid query") . mysqli_error($link);
        $volume->setId(mysqli_insert_id($link));
        mysqli_close($link);
    }

    public static function select($id_library, $cb) {
        $link = BaseDB::connect();
        $sql = "SELECT * FROM `manga` m INNER JOIN volume v ON m.id = v.id_manga WHERE id_library = $id_library";
        $res = mysqli_query($link, $sql) or die("Invalid query") . mysqli_error($link);
        while ($row = mysqli_fetch_assoc($res)) {
            $cb($row);
        }
        mysqli_close($link);
    }

}
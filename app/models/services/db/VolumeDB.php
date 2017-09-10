<?php
/**
 * Created by IntelliJ IDEA.
 * User: sayaka
 * Date: 2017/08/21
 * Time: 22:11
 */

namespace app\models\services\db;


class VolumeDB {
    public static function insert($library, $manga, $volume) {
        $link = BaseDB::connect();
        $manga_id = $manga->getId();
        $id_library = $library->getId();
        $volume_number = mysqli_real_escape_string($link, $volume->getVolumeNumber());
        $path = mysqli_real_escape_string($link, $volume->getPath());
        $file_names = mysqli_real_escape_string($link, implode(",", $volume->getFileNames()));

        $sql = "SELECT v.id FROM manga m INNER JOIN volume v ON m.id = v.id_manga WHERE id_library = $id_library AND path = '$path'"; ////verifie si le meme "manga" existe
        $res = mysqli_query($link, $sql) or die(mysqli_error($link));
        $row = mysqli_fetch_assoc($res);

        if(empty($row)) {
            $sql = "INSERT INTO volume(id, id_manga, volume_number, path, add_date, access_date, read_status, page_number, file_names, to_delete)
                VALUES (NULL, '$manga_id', '$volume_number', '$path', NOW(), NULL, 0, 0, '$file_names', 0)";
            mysqli_query($link, $sql) or die(mysqli_error($link));
            $volume->setId(mysqli_insert_id($link));
        } else {
            $volume_id = $row["id"];
            $sql = "UPDATE volume SET to_delete = 0 WHERE id = $volume_id";
            mysqli_query($link, $sql) or die(mysqli_error($link));
            $volume->setId($volume_id);
        }
        mysqli_close($link);
    }

    public static function select($id_library, $cb) {
        $link = BaseDB::connect();
        $sql = "SELECT * FROM manga m INNER JOIN volume v ON m.id = v.id_manga WHERE id_library = $id_library";
        $res = mysqli_query($link, $sql) or die(mysqli_error($link));
        while ($row = mysqli_fetch_assoc($res)) {
            $cb($row);
        }
        mysqli_close($link);
    }

    public static function markToDelete($library) {
        $link = BaseDB::connect();
        $id_library = $library->getId();
        $sql = "UPDATE volume v INNER JOIN manga m ON m.id = v.id_manga SET v.to_delete = 1 WHERE id_library = $id_library";
        mysqli_query($link, $sql) or die(mysqli_error($link));
        mysqli_close($link);
    }


    public static function toDelete($library) {
        $link = BaseDB::connect();
        $id_library = $library->getId();
        $sql = "DELETE volume FROM volume INNER JOIN manga ON manga.id = volume.id_manga WHERE manga.id_library = $id_library AND volume.to_delete = 1";
        phpinfo();
        var_dump($sql);
        mysqli_query($link, $sql) or die(mysqli_error($link));
        mysqli_close($link);
    }

}
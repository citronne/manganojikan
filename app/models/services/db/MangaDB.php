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
        $name = mysqli_real_escape_string($link, $manga->getName());
        $sql = "SELECT id FROM manga WHERE name = '$name' AND id_library = $library_id"; //verifie si le meme "name" existe
        $res = mysqli_query($link, $sql) or die(mysqli_error($link));
        $row = mysqli_fetch_assoc($res);
        if (empty($row)) {
            $sql = "INSERT INTO manga(id, id_library, name, to_delete) VALUES (NULL, '$library_id', '$name', 0)" ;
            echo $sql;
            mysqli_query($link, $sql) or die(mysqli_error($link));
            $manga->setId(mysqli_insert_id($link));
        } else {
            $manga_id = $row["id"];
            $sql = "UPDATE manga SET to_delete = 0 WHERE id = $manga_id";
            mysqli_query($link, $sql) or die(mysqli_error($link));
            $manga->setId($manga_id);

        }
        mysqli_close($link);
    }

    public static function select($id_library, $cb) {
        $link = BaseDB::connect();
        $sql = "SELECT * FROM manga WHERE id_library = $id_library";
        $res = mysqli_query($link, $sql) or die(mysqli_error($link));
        while ($row = mysqli_fetch_assoc($res)) {
            $cb($row);
        }
        mysqli_close($link);
    }

    public static function markToDelete($library) {
        $link = BaseDB::connect();
        $library_id = $library->getId();
        $sql = "UPDATE manga SET to_delete = 1 WHERE id_library = $library_id";
        mysqli_query($link, $sql) or die(mysqli_error($link));
        mysqli_close($link);
    }

    public static function toDelete($library) {
        $link = BaseDB::connect();
        $library_id = $library->getId();
        $sql = "DELETE FROM manga WHERE id_library = $library_id AND to_delete = 1";
        mysqli_query($link, $sql) or die(mysqli_error($link));
        mysqli_close($link);
    }
}
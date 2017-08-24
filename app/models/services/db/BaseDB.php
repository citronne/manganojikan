<?php

namespace app\models\services\db;
use app\models\data\Library;
use app\models\data\Manga;
use app\models\data\Volume;

/**
 * Created by IntelliJ IDEA.
 * User: sayaka
 * Date: 2017/08/20
 * Time: 16:37
 */
class BaseDB {
    public static function connect() {
        $link = mysqli_connect("localhost", "root", "") or die("Connect error" . mysqli_connect_error());
        mysqli_select_db($link, "manganojikan");
        return $link;
    }

    public static function clearAll() {
        $link = BaseDB::connect();
        $sql = "DELETE FROM library";
        mysqli_query($link, $sql);
        $sql = "DELETE FROM manga";
        mysqli_query($link, $sql);
        $sql = "DELETE FROM volume";
        mysqli_query($link, $sql);
        mysqli_close($link);
    }

    public static function saveToDB($library){
        BaseDB::clearAll();
        LibraryDB::insert($library);

        $mangas = $library->getMangas();
        foreach ($mangas as $manga_name => $manga) {
            MangaDB::insert($library, $manga);
            $volumes = $manga->getVolumes();
            foreach ($volumes as $volume_number => $volume) {
                VolumeDB::insert($manga, $volume);
            }
        }

    }
    
    public static function loadDB() {
        if ($row = LibraryDB::select()){
            $id = $row["id"];
            $path = $row["path"];
            $library = new Library($path);
        }

        if ($row = MangaDB::select()){
            $id = $row["id"];
            $id_library = $row["id_library"];
            $name = $row["name"];
            $manga = new Manga($name);
        }

        if ($row = VolumeDB::select()){
            $id = $row["id"];
            $id_manga = $row["id_manga"];
            $volume_number = $row["volume_number"];
            $path = $row["path"];
            $add_date = $row["add_date"];
            $access_date = $row["access_date"];
            $read_status = $row["read_status"]
            $volume = new Volume($volume_number, $path, $manga, , );
        }
    }
}
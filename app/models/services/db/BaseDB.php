<?php

namespace app\models\services\db;
use app\models\data\Library;
use app\models\data\Manga;
use app\models\data\Volume;
use app\models\data\User;
use app\models\services\UserService;

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

    public static function saveToDB($library, $id_user){
        BaseDB::clearAll();
        LibraryDB::insert($library);
        $id_library = $library->getId();
        UserDB::insertIdLibrary($id_user, $id_library);
        
        $mangas = $library->getMangas();
        foreach ($mangas as $manga_name => $manga) {
            MangaDB::insert($library, $manga);
            $volumes = $manga->getVolumes();
            foreach ($volumes as $volume_number => $volume) {
                VolumeDB::insert($manga, $volume);
            }
        }

    }

    public static function loadDB($id_user) {
        $mangas = array();

        $row = LibraryDB::selectByUserId($id_user);
        if (empty($row)){
            return null;
        }

        var_dump($row);
        $id_library = $row["id"];
        $path = $row["path"];
        $library = new Library($path, $id_library);

        MangaDB::select($id_library, function ($row) use (&$library, &$mangas) {
            $id = $row["id"];
            $name = $row["name"];
            $manga = new Manga($name, $id);
            var_dump($manga);
            $library->addManga($manga);
            $mangas[$id] = $manga;
        });


        VolumeDB::select($id_library, function ($row) use (&$mangas) {
            $id = $row["id"];
            $id_manga = $row["id_manga"];
            $volume_number = $row["volume_number"];
            $path = $row["path"];
            $add_date = $row["add_date"];
            $access_date = $row["access_date"];
            $read_status = $row["read_status"];
            $current_manga = $mangas[$id_manga];
            $file_names = explode(",", $row["file_names"]);
            $cover = '/manga/' . $current_manga->getName() . '/volume/' . $volume_number . '/' . $file_names[0];
            $volume = new Volume($volume_number, $path, $cover, $file_names);
            
            $current_manga->addVolume($volume);
        });

        return $library;
    }
}
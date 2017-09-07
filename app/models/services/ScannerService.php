<?php

namespace app\models\services;

use app\models\data\Library;
use app\models\data\Manga;
use app\models\data\Volume;
use app\models\services\db\BaseDB;

class ScannerService {
    public function scan($library_path) {
        $library = new Library($library_path);
        $files = scandir($library_path); //scanner des dossiers(et fichiers) et envoie un array

        //var_dump($files);

        for($i = 0; $i < count($files); $i++) {
            $manga_file = $files[$i];
            if($manga_file != "." && $manga_file != "..") {
                //echo $manga_file, PHP_EOL;
                $file_name = explode(".", $manga_file); //separer avec "."
                //echo $file_name[0], PHP_EOL; //"nom de manga" _ "numero de volume"
    
                $name = explode("_", $file_name[0]); //separer avec "_"
                //echo $name[0], PHP_EOL; //nom de manga
                //echo $name[1], PHP_EOL; //numero de volume
                //echo $library_path . $manga_file, PHP_EOL;
    
                $manga_name = $name[0];
                $manga = $library->getManga($manga_name);
                if ($manga == null) {
                    $manga = new Manga($manga_name); //creer le nouveau
                    $library->addManga($manga);
                }
                //var_dump($manga);
                $volume_path = $library_path . "\\" . $manga_file;

                $manga_files = scandir($volume_path); //scanner des fichiers dans le dossier

                $file_names = array();
                for($j = 2; $j < count($manga_files); $j++) {
                    array_push($file_names, str_replace('.', '_', $manga_files[$j])); //remplacer des "." par "_" pour puvoir afficher des phptos sur navigateur
                }

                $volume_number = $name[1];
                $cover = '/manga/' . $manga_name . '/volume/' . $volume_number . '/' . $file_names[0]; //recuperer le premier fichier

                $volume = new Volume($name[1], $volume_path, $cover, $file_names);
                $manga->addVolume($volume);
                //$manga = new Manga($name[0], $name[1], $library_path . "\\" . $manga_file);
                //array_push($mangas, $manga);
    
            }
        }

        BaseDB::saveToDB($library);
        return $library;

    }

}
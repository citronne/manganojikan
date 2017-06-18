<?php

namespace app\models\services;

use app\models\data\Manga;
use app\models\data\Volume;

class ScannerService {
    public function scan($library_path) {
        $files = scandir($library_path); //scanner des dossiers(et fichiers) et envoie un array
        $mangas = array(); //creer un array pour ranger des mangas par nom
    
        for($i = 0; $i < count($files); $i++) {
            $manga_file = $files[$i];
            if($manga_file != "." && $manga_file != "..") {
                //echo $manga_file, PHP_EOL;
                $file_name = explode(".", $manga_file); //separer avec "."
                //echo $file_name[0], PHP_EOL; //"nom de manga" _ "numero de volume"
    
                $name = explode("_", $file_name[0]); //separer avec "_"
                //echo $name[0], PHP_EOL; //nom
                //echo $name[1], PHP_EOL; //numero de volume
                //echo $library_path . $manga_file, PHP_EOL;
    
                $manga_name = $name[0];
                if(!in_array($manga_name, $mangas)){
                    $manga = new Manga($manga_name); //creer le nouveau
                    $mangas[$manga_name] = $manga; //et mettre
                } else {
                    $manga = $mangas[$manga_name];
                }
                $volume_path = $library_path . "\\" . $manga_file;

                $manga_files = scandir($volume_path); //scanner des fichiers dans le dossier et
                $new_manga_files = str_replace('.', '_', $manga_files[2]); //([0]: ., [1]: ..)
                $cover = '/manga/' . $manga_name . '/volume/' . $name[1] . '/' . $new_manga_files; //recuperer le premier fichier

                $file_names = array();
                for($i = 2; $i < count($manga_files); $i++) {
                    array_push($file_names, str_replace('.', '_', $manga_files[$i]));
                }

                $volume = new Volume($name[1], $volume_path, $manga, $cover, $file_names);
                $manga->addVolume($volume);
                //$manga = new Manga($name[0], $name[1], $library_path . "\\" . $manga_file);
                //array_push($mangas, $manga);
    
            }
        }
    
        return $mangas;
    }
    
}
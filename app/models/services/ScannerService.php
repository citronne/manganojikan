<?php

namespace app\models\services;

use app\models\data\Manga;
use app\models\data\Volume;

class ScannerService {
    public function scan($library_path) {
        $files = scandir($library_path); //scanner des fichiers et envoie un array
        $mangas = array(); //creer un array pour ranger des mangas par nom
    
        for($i = 0; $i < count($files); $i++) {
            $manga_file = $files[$i];
            if($manga_file != "." && $manga_file != "..") {
                echo $manga_file, PHP_EOL;
                $file_name = explode(".", $manga_file); //separer avec "."
                echo $file_name[0], PHP_EOL; //"nom de manga" _ "numero de volume"
    
                $name = explode("_", $file_name[0]); //separer avec "_"
                echo $name[0], PHP_EOL; //nom
                echo $name[1], PHP_EOL; //numero de volume
                echo $library_path . $manga_file, PHP_EOL;
    
                $manga_name = $name[0];
                if(!in_array($manga_name, $mangas)){
                    $manga = new Manga($manga_name); //creer le nouveau
                    $mangas[$manga_name] = $manga; //et mettre
                } else {
                    $manga = $mangas[$manga_name];
                }
    
                $volume = new Volume($name[1], $library_path . "\\" . $manga_file, $manga);
                $manga->addVolume($volume);
                //$manga = new Manga($name[0], $name[1], $library_path . "\\" . $manga_file);
                //array_push($mangas, $manga);
                
                
    
            }
        }
    
        return $mangas;
    }
    
}
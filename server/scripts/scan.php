<?php
    class Manga {
        private $name;
        private $volumes;

        public function __construct($name) {
            $this->name = $name;
            $this->volumes = array();
        }

        public function getName() {
            return $this->name;
        }

        public function getVolumes() {
            return $this->volumes;
        }

        public function addVolume($volume) {
            array_push($this->volumes, $volume);
        }

        public function __toString() {
            return $this->name;
        }
    }

    class Volume {
        private $volume_number;
        private $path;
        private $add_date;
        private $access_date;
        private $read;
        private $page_number;
        private $manga;

        public function __construct($volume_number, $path, $manga) {
            $this->volume_number = $volume_number;
            $this->path = $path;
            $this->manga = $manga;
        }

        public function getPath() {
            return $this->path;
        }
    }

    function scan($library_path) {
        $files = scandir($library_path); //scanner des fichiers et envoie un array
        $mangas = array(); //creer un array pour ranger des mangas par nom

        for($i = 0; $i < count($files); $i++) {
            $manga_file = $files[$i];
            if($manga_file != "." && $manga_file != "..") {
                echo $manga_file, PHP_EOL;
                $a = explode(".", $manga_file); //separer avec "."
                echo $a[0], PHP_EOL; //"nom de manga" _ "numero de volume"

                $b = explode("_", $a[0]); //separer avec "_"
                echo $b[0], PHP_EOL; //nom
                echo $b[1], PHP_EOL; //numero de volume
                echo $library_path . $manga_file, PHP_EOL;

                $manga_name = $b[0];
                if(!in_array($manga_name, $mangas)){
                    $manga = new Manga($manga_name); //creer le nouveau
                    $mangas[$manga_name] = $manga; //et mettre
                } else {
                    $manga = $mangas[$manga_name];
                }

                $volume = new Volume($b[1], $library_path . "\\" . $manga_file, $manga);
                $manga->addVolume($volume);
                //$manga = new Manga($b[0], $b[1], $library_path . "\\" . $manga_file);
                //array_push($mangas, $manga);

            }
        }

        return $mangas;
    }

    $mangas = scan("D:\\manga");
    $mangamamaladeboy = $mangas["mamaladeboy"];

    echo count($mangamamaladeboy->getVolumes());
    $volumes = $mangamamaladeboy->getVolumes();
    echo $volumes[0]->getPath();


?>
<?php
    class Manga {
        private $name;
        private $volume;
        private $path;

        public function getName() {
            return $this->name;
        }

        public function getVolume() {
            return $this->volume;
        }

        public function getPath() {
            return $this->path;
        }

        public function __construct($name,$volume,$path) {
            $this->name = $name;
            $this->volume = $volume;
            $this->path = $path;
        }
    }


    function scan($library_path) {
        $files = scandir($library_path);
        $mangas = array();

        for($i = 0; $i < count($files); $i++) {
            $manga_file = $files[$i];
            if($manga_file != "." && $manga_file != "..") {
                echo $manga_file, PHP_EOL;
                $a = explode(".", $manga_file);
                echo $a[0], PHP_EOL;

                $b = explode("_", $a[0]);
                echo $b[0], PHP_EOL;
                echo $b[1], PHP_EOL;
                echo $library_path . $manga_file, PHP_EOL;
                $manga = new Manga($b[0], $b[1], $library_path . "\\" . $manga_file);
                array_push($mangas, $manga);
            }
        }

        return $mangas;
    }

    $mangas = scan("D:\\manga");

    echo $mangas[0]->getName(), PHP_EOL;

?>
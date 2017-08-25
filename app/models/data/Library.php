<?php
/**
 * Created by IntelliJ IDEA.
 * User: sayaka
 * Date: 2017/08/20
 * Time: 17:01
 */

namespace app\models\data;


class Library {
    private $id;
    private $path;
    private $mangas;

    public function __construct($path, $id = null) {
        $this->id = $id;
        $this->path = $path;
        $this->mangas = array();
    }

    public function getMangas() {
        return $this->mangas;
    }
    
    public function addManga($manga) {
        $manga_name = $manga->getName();
        $this->mangas[$manga_name] = $manga;
    }
    
    public function getPath() {
        return $this->path;
    }
    
    public function getId() {
        return $this->id;
    }
    
    public function setId($id) {
        $this->id = $id;
    }
    
    public function getManga($manga_name) {
       if (in_array($manga_name, $this->mangas)){
           return $this->mangas[$manga_name];
       } else {
           return null;
       }
    }
}
<?php
/**
 * Created by IntelliJ IDEA.
 * User: sayaka
 * Date: 2017/06/17
 * Time: 21:00
 */
namespace app\models\data;

class Volume implements \JsonSerializable {
    private $id;
    private $volumeNumber;
    private $path;
    private $add_date;
    private $access_date;
    private $read;
    private $page_number;
    private $manga;
    private $cover;
    private $file_names;

    public function __construct($volumeNumber, $path, $manga, $cover, $file_names) {
        $this->volumeNumber = $volumeNumber;
        $this->path = $path;
        $this->manga = $manga;
        $this->cover = $cover;
        $this->file_names = $file_names;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getPath() {
        return $this->path;
    }

    public function getManga() {
        return $this->manga;
    }

    public function getVolumeNumber() {
        return $this->volumeNumber;
    }
    
    public function getCover() {
        return $this->cover;
    }
    
    public function saveFiles() {
        return $this->file_names;
    }

    public function jsonSerialize() {
        $vars = get_object_vars($this);
        return $vars;
    }
}
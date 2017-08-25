<?php
/**
 * Created by IntelliJ IDEA.
 * User: sayaka
 * Date: 2017/06/17
 * Time: 20:59
 */
namespace app\models\data;

class Manga {
    private $id;
    private $name;
    private $volumes;

    public function __construct($name, $id = null) {
        $this->id = $id;
        $this->name = $name;
        $this->volumes = array();
    }
    
    public function getId() {
        return $this->id;
    }
    
    public function setId($id) {
        $this->id = $id;
    }
    public function getName() {
        return $this->name;
    }

    public function getVolumes() {
        return $this->volumes;
    }

    public function getVolume($volume_number) {
        return $this->volumes[$volume_number];
    }

    public function getCover() {
        $first_volume = array_values($this->volumes)[0];
        return $first_volume->getCover();
    }
    
    public function addVolume($volume) {
        $volume_number = $volume->getVolumeNumber();
        $this->volumes[$volume_number] = $volume;
    }

    public function __toString() {
        return $this->name;
    }
}

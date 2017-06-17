<?php
/**
 * Created by IntelliJ IDEA.
 * User: sayaka
 * Date: 2017/06/17
 * Time: 20:59
 */
namespace app\models\data;

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

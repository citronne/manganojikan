<?php
/**
 * Created by IntelliJ IDEA.
 * User: sayaka
 * Date: 2017/06/17
 * Time: 21:00
 */
namespace app\models\data;

class Volume {
    private $volume_number;
    private $path;
    private $add_date;
    private $access_date;
    private $read;
    private $page_number;
    private $manga;
    private $cover;

    public function __construct($volume_number, $path, $manga) {
        $this->volume_number = $volume_number;
        $this->path = $path;
        $this->manga = $manga;
    }

    public function getPath() {
        return $this->path;
    }
    
    public function getCover() {
        return 3;
    }
}
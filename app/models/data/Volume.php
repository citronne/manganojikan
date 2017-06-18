<?php
/**
 * Created by IntelliJ IDEA.
 * User: sayaka
 * Date: 2017/06/17
 * Time: 21:00
 */
namespace app\models\data;

class Volume
{
    private $volumeNumber;
    private $path;
    private $add_date;
    private $access_date;
    private $read;
    private $page_number;
    private $manga;
    private $cover;

    public function __construct($volumeNumber, $path, $manga, $cover) {
        $this->volumeNumber = $volumeNumber;
        $this->path = $path;
        $this->manga = $manga;
        $this->cover = $cover;
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
}
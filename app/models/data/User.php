<?php
/**
 * Created by IntelliJ IDEA.
 * User: sayaka
 * Date: 2017/08/27
 * Time: 19:39
 */

namespace app\models\data;


class User {
    private $id;
    private $user_name;
    private $library;
    
    public function __construct($user_name, $mangas) {
        $this->user_name = $user_name;
        $this->mangas = array();
    }
    
    public function setId($id) {
        $this->id = $id;
    }

    public function getId() {
        return $this->id;
    }
    
    public function getMangas() {
        return $this->mangas;
    }
    
    public function getAccessDate() {
        return $this->access_date;
    }

    public function getReadStatus() {
        return $this->read_status;
    }
    
    public function setPageNumber($page_number) {
        $this->page_number = $page_number;
    }
}
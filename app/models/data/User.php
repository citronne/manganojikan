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
    
    public function __construct($user_name, $library) {
        $this->user_name = $user_name;
        $this->library = $library;
    }
    
    public function setId($id) {
        $this->id = $id;
    }

    public function getId() {
        return $this->id;
    }
    
    public function getUserName() {
        return $this->user_name;
    }

    public function getLibrary() {
        return $this->library;
    }
}
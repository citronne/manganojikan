<?php

namespace app\models\services;
use app\models\services\db\BaseDB;
use app\models\services\db\VolumeDB;

/**
 * Created by IntelliJ IDEA.
 * User: sayaka
 * Date: 2017/08/23
 * Time: 19:53
 */
class LibraryService{
    public function loadLibrary($id_user) {
        return BaseDB::loadDB($id_user);
    }
    
    public function updatePageNumber($page_number, $volume){
        return VolumeDB::updatePageNumber($page_number, $volume);
    }
    
    public function searchMangaName($id_user, $text) {
        return BaseDB::searchFor($id_user, $text);
    }
}
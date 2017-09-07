<?php

namespace app\models\services;
/**
 * Created by IntelliJ IDEA.
 * User: sayaka
 * Date: 2017/08/23
 * Time: 19:53
 */
class LibraryService{
    public function loadLibrary($id_user) {
        return \app\models\services\db\BaseDB::loadDB($id_user);
    }
}
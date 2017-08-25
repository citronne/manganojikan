<?php
/**
 * Created by IntelliJ IDEA.
 * User: sayaka
 * Date: 2017/06/17
 * Time: 23:30
 */

require 'db/BaseDB.php';
require '../data/Manga.php';
require '../data/Volume.php';
require '../data/Library.php';

require 'db/LibraryDB.php';
require 'db/MangaDB.php';
require 'db/VolumeDB.php';

/*require 'ScannerService.php';
require '../data/Manga.php';
require '../data/Volume.php';
require '../data/Library.php';
*/
/*$service = new \app\models\services\ScannerService();
$mangas = $service->scan("D:\\manga");
$mangas_7SEEDS = $mangas["7SEEDS"];
var_dump($mangas);
var_dump($mangas["7SEEDS"]);
var_dump($mangas_7SEEDS->getVolume("01"));
*/

\app\models\services\db\BaseDB::loadDB();
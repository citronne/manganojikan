<?php
/**
 * Created by IntelliJ IDEA.
 * User: sayaka
 * Date: 2017/06/17
 * Time: 23:30
 */

require 'ScannerService.php';
require '../data/Manga.php';
require '../data/Volume.php';

$service = new \app\models\services\ScannerService();
$mangas = $service->scan("D:\\manga");
$mangas_7SEEDS = $mangas["7SEEDS"];
var_dump($mangas);
var_dump($mangas["7SEEDS"]);
var_dump($mangas_7SEEDS->getVolume("01"));
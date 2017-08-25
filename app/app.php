<?php
/**
 * Created by IntelliJ IDEA.
 * User: sayaka
 * Date: 2017/08/25
 * Time: 18:40
 */

require '../vendor/autoload.php';

session_start();

$app = new \Slim\App([
    "settings" => [
        "displayErrorDetails" => true
    ]
]);

require 'container.php';
require 'routing.php';

$app->run();
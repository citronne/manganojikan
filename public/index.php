<?php
/**
 * Created by IntelliJ IDEA.
 * User: sayaka
 * Date: 2017/06/10
 * Time: 18:42
 */
require '../vendor/autoload.php';

$app = new \Slim\App([
    "settings" => [
        "displayErrorDetails" => true
    ]
]);

require '../app/container.php';
require '../app/routing.php';

$app->run();
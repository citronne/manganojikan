<?php

$app->get("/", \app\controllers\PagesController::class . ':home')->setName('homepage');
$app->get("/manga/{name}", \app\controllers\PagesController::class . ':manga')->setName('manga');
$app->get("/manga/{name}/volume/{number}", \app\controllers\PagesController::class . ':reader')->setName('reader');

/*
$app->get('/contact', \app\controllers\PagesController::class . ':getContact')->setName('contact');
$app->post('/contact', \app\controllers\PagesController::class . ':postContact');
*/

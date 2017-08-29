<?php

$app->get("/", \app\controllers\PagesController::class . ':home')->setName('homepage');
$app->get("/manga/{name}", \app\controllers\PagesController::class . ':manga')->setName('manga');
$app->get("/manga/{name}/volume/{number}", \app\controllers\PagesController::class . ':reader')->setName('reader');
$app->get("/manga/{name}/volume/{number}/reader", \app\controllers\PagesController::class . ':readerJson');
$app->get("/manga/{name}/volume/{number}/{image_name}", \app\controllers\PagesController::class . ':sendImage');
$app->get("/register", \app\controllers\PagesController::class . ':register')->setName('register');
$app->get("/login", \app\controllers\PagesController::class . ':login')->setName('login');
$app->get("/setting", \app\controllers\PagesController::class . ':setting')->setName('setting');
$app->get("/scan", \app\controllers\PagesController::class . ':scan')->setName('scan');

$app->post("/register", \app\controllers\PagesController::class . ':createNewUser')->setName('register');

/*
$app->get('/contact', \app\controllers\PagesController::class . ':getContact')->setName('contact');
$app->post('/contact', \app\controllers\PagesController::class . ':postContact');
*/

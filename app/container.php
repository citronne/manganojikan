<?php

// Get container
$container = $app->getContainer();

// Register component on container
$container['view'] = function ($container) {
    $dir = dirname(__DIR__);
    $view = new \Slim\Views\Twig($dir . '/app/views', [
        'cache' => false, //$dir . '/tmp/cache'
        'debug' => true
    ]);

    $view->addExtension(new \Twig_Extension_Debug());

    // Instantiate and add Slim specific extension
    $basePath = rtrim(str_ireplace('index.php', '', $container['request']->getUri()->getBasePath()), '/');
    $view->addExtension(new Slim\Views\TwigExtension($container['router'], $basePath));

    return $view;

};

$container['scanner'] = function ($container) {
  return new app\models\services\ScannerService();
};
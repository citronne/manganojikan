<?php
/**
 * Created by IntelliJ IDEA.
 * User: sayaka
 * Date: 2017/06/13
 * Time: 22:25
 */
namespace app\controllers;

class Controller {
    protected $container;
    
    public function __construct($container) {
        $this->container = $container;
    }
    
    public function render($response, $template, $params = []) {
        $this->container->view->render($response, $template, $params);
    }
    
    public function redirect($response, $name, $params = []) {
        $router = $this->container->get('router');
        return $response->withRedirect($router->pathFor($name, $params));
    }
}
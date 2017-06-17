<?php
/**
 * Created by IntelliJ IDEA.
 * User: sayaka
 * Date: 2017/06/11
 * Time: 14:32
 */

namespace app\controllers;

class PagesController extends Controller {
    
    public function home($request, $response, $args) {
        $mangas = $this->container->scanner->scan('D:\\manga');
        file_put_contents('php://stderr', print_r($mangas, TRUE));
        $this->render($response, 'pages/library.twig', ['mangas' => $mangas]);
    }
    
    public function manga($request, $response, $args) {
        $this->render($response, 'pages/library.twig');
    }

    public function reader($request, $response, $args) {
        $this->render($response, 'pages/reader.twig');
    }

    /*public function getContact($request, $response, $args) {
        $this->render($response, 'pages/contact.twig');
    }

    public function postContact($request, $response, $args) {
        $_SESSION['flash'];
        return $this->redirect  ($response,'contact');
    }
    */
}
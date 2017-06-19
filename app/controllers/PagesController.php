<?php
/**
 * Created by IntelliJ IDEA.
 * User: sayaka
 * Date: 2017/06/11
 * Time: 14:32
 */

namespace app\controllers;

use Slim\Http\Request;
use Slim\Http\Response;

class PagesController extends Controller {
    
    public function home($request, $response, $args) {
        $mangas = $this->container->scanner->scan('D:\\manga');
        var_dump($mangas);
        //file_put_contents('php://stderr', print_r($mangas, TRUE));
        $this->render($response, 'pages/library.twig', ['mangas' => $mangas]);
    }
    
    public function manga($request, $response, $args) {
        $mangas = $this->container->scanner->scan('D:\\manga');
        $manga_name = $args["name"];
        $manga = $mangas[$manga_name];
        $this->render($response, 'pages/library_volumes.twig', ['manga' => $manga]);
    }

    public function reader($request, $response, $args) {
        $this->render($response, 'pages/reader.twig');
    }

    public function sendImage(Request $request, Response $response, $args) {
        $manga_name = $args["name"];
        $volume_number = $args["number"];
        $img_name = $args["image_name"];
        
        $part = explode('_', $img_name);

        $mangas = $this->container->scanner->scan('D:\\manga');

        $manga = $mangas[$manga_name];
        $volume = $manga->getVolume($volume_number);
        $path = $volume->getPath();
        $path_complete = $path . '\\' . $part[0] . '.' . $part[1];

        $file = file_get_contents($path_complete);
        $response = $response->withAddedHeader('Content-Type', 'image/' . $part[1]);
        return $response->write($file);
    }

    public function readerJson(Request $request, Response $response, $args) {
        $manga_name = $args["name"];
        $volume_number = $args["number"];
        $mangas = $this->container->scanner->scan('D:\\manga');
        $manga = $mangas[$manga_name];
        $volume = $manga->getVolume($volume_number);
        $json = json_encode($volume);
        $response = $response->withAddedHeader('Content-Type', 'application/json');
        return $response->write($json);
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
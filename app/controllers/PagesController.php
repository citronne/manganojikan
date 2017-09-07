<?php
/**
 * Created by IntelliJ IDEA.
 * User: sayaka
 * Date: 2017/06/11
 * Time: 14:32
 */

namespace app\controllers;

use app\models\services\UserService;
use Slim\Http\Request;
use Slim\Http\Response;

class PagesController extends Controller
{

    public function home($request, $response, $args) {
        if (isset($_SESSION["user"])) {
            if (!isset($library)) {
                $this->render($response, 'pages/setting.twig');
            } else {
                $mangas = $this->container->library->getMangas();
                $this->render($response, 'pages/library.twig', ['mangas' => $mangas]);
            }
        } else {
            $this->render($response, 'pages/homepage.twig');
        }

    }

    public function manga($request, $response, $args) {
        if (!isset($_SESSION["user"])){
            return $this->redirect($response, 'login');
        }
        $mangas = $this->container->library->getMangas();
        $manga_name = $args["name"];
        $manga = $mangas[$manga_name];
        $this->render($response, 'pages/library_volumes.twig', ['manga' => $manga]);
    }

    public function reader($request, $response, $args) {
        if (!isset($_SESSION["user"])){
            return $this->redirect($response, 'login');
        }
        $mangas = $this->container->library->getMangas();
        $manga_name = $args["name"];
        $manga = $mangas[$manga_name];
        $this->render($response, 'pages/reader.twig', ['manga' => $manga]);
    }

    public function register($request, $response, $args) {
        $this->render($response, 'pages/register.twig');
    }

    public function createNewUser($request, $response, $args) {
        $error_msg =[];
        $user_name = $_POST["user_name"];
        $password = $_POST["password"];
        $password2 = $_POST["password2"];
        $isUserFree = $this->container->userService->verify($user_name);
        
        if (!$isUserFree){
            array_push($error_msg, "Nom de utilisateur déjà existe. Veuillez changez le nom.");
        }
        if (empty($user_name)) {
            array_push($error_msg, "Veuillez inserer le nom de utilisateur.");
        }
        if (empty($password)) {
            array_push($error_msg, "Veuillez inserer le mot de passe.");
        }
        if (empty($password)) {
            array_push($error_msg, "Veuillez inserer le mot de passe pour confirmer.");
        }

        if ($password != $password2) {
            array_push($error_msg, "Mot de passe ne correspond pas. Veuillez reinserer le mot de passe.");
        }

        if (empty($error_msg)) {
            $this->container->userService->createUser($user_name, $password);
            $_SESSION['registerMessage'] = "Merci d'avoir créer votre compte!";
            return $this->redirect($response, 'login');
        } else {
            $this->render($response, 'pages/register.twig', ['error' => $error_msg]);
        }
    }

    public function login($request, $response, $args) {

        if (isset($_SESSION['registerMessage'])) {
            $this->render($response, 'pages/login.twig', ['msg' => $_SESSION['registerMessage']]);
            unset($_SESSION['registerMessage']);
        } else {
            $this->render($response, 'pages/login.twig');
        }
    }

    public function identify($request, $response, $args) {
        $user_name = $_POST["id"];
        $password = $_POST["password"];
        $user = $this->container->userService->identify($user_name, $password);
        if($user == null) {
            return $this->render($response, 'pages/login.twig', ['msg' => "Le nom de utilisateur ou le mot de passe est invalide. Veuilllez reinserer."]);
        } else {
            $_SESSION["user"] = $user;
            return $this->redirect($response, 'homepage');
        }
    }

    public function profile($request, $response, $args) {
        if (!isset($_SESSION["user"])){
            return $this->redirect($response, 'login');
        }
        $user = $_SESSION["user"];
        $user_name = $user->getUserName();
        $this->render($response, 'pages/profile.twig', ['user' => $user_name]);
    }

    public function logout($request, $response, $args) {
        unset($_SESSION["user"]);
        return $this->redirect($response, 'homepage');
    }

    public function setting($request, $response, $args) {
        if (!isset($_SESSION["user"])){
            return $this->redirect($response, 'login');
        }
        $this->render($response, 'pages/setting.twig');
    }

    public function sendImage(Request $request, Response $response, $args) {
        if (!isset($_SESSION["user"])){
            return $this->redirect($response, 'login');
        }
        header_remove('Cache-Control');
        header_remove('Pragma');

        $manga_name = $args["name"];
        $volume_number = $args["number"];
        $img_name = $args["image_name"];

        $part = preg_split('~_(?=[^_]*$)~', $img_name);
        //var_dump($part);

        $mangas = $this->container->library->getMangas();

        $manga = $mangas[$manga_name];
        $volume = $manga->getVolume($volume_number);
        $path = $volume->getPath();
        //var_dump($path);
        $path_complete = $path . '\\' . $part[0] . '.' . $part[1];

        $file = file_get_contents($path_complete);
        $response = $response
            ->withHeader('Cache-Control', 'max-age=2592000, public')
            ->withHeader('Content-Type', 'image/' . $part[1])
            ->withoutHeader('Pragma');
        return $response->write($file);
    }

    public function readerJson(Request $request, Response $response, $args) {
        if (!isset($_SESSION["user"])){
            return $this->redirect($response, 'login');
        }
        $manga_name = $args["name"];
        $volume_number = $args["number"];
        $mangas = $this->container->library->getMangas();
        $manga = $mangas[$manga_name];
        $volume = $manga->getVolume($volume_number);
        $json = json_encode($volume);
        $response = $response->withAddedHeader('Content-Type', 'application/json');
        return $response->write($json);
    }

    public function scan(Request $request, Response $response, $args) {
        if (!isset($_SESSION["user"])){
            return $this->redirect($response, 'login');
        }
        $user = $_SESSION["user"];
        $user_id = $user->getId();
        $library = $this->container->scanner->scan('D:\\manga', $user_id);
        unset($_SESSION["library"]);
        return $this->redirect($response, 'homepage', ['mangas' => $library]);
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
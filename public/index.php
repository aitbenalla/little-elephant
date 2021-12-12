<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';

use App\Controller\AppController;
use App\Controller\PostController;
use App\Controller\AuthorController;
use App\Controller\SecurityController;
use App\Controller\AdminController;

$request = $_SERVER['REQUEST_URI'];
$app = new AppController();
$post = new PostController();
$author = new AuthorController();
$admin = new AdminController();
$security = new SecurityController();

if (str_ends_with($request, '/')) {
    $request = substr($request, 0, -1);
}

if (preg_match('/\/admin/', $request) && !preg_match('/\/admin\/login/',$request) && !preg_match('/\/admin\/new/',$request))
{
    if (isset($_SESSION['admin']))
    {
        switch ($request) {
            case '/admin':
                $admin->dashboard();
                break;
            case '/admin/author':
                $author->list();
                break;
            default:
                http_response_code(404);
                $app->error();
                break;
        }
    }
    else {
        header('Refresh:0; url=/admin/login');
    }
}
else {
    switch ($request) {
        case '/home':
        case '':
            $app->index();
            break;
        case '/authors':
            $author->list();
            break;
        case '/posts':
            $post->list();
            break;
        case '/signup':
            $author->save();
            break;
        case '/signin':
            $author->save();
            break;
        case '/admin/login':
            $security->loginAdmin();
            break;
        case '/admin/new':
            $admin->save();
            break;
        default:
            http_response_code(404);
            $app->error();
            break;
    }
}

//if ($_GET) {
//    switch ($request) {
//        case '/author/edit?id=' . $_GET['id']:
//            if (preg_match('/^\d+$/', $_GET['id'])) {
//                $author->save($_GET['id']);
//            } else {
//                echo 'invalid ID';
//            }
//            break;
//        case '/author/delete?id=' . $_GET['id']:
//            if (preg_match('/^\d+$/', $_GET['id'])) {
//                $author->deleteAuthor($_GET['id']);
//            } else {
//                echo 'invalid ID';
//            }
//            break;
//        default:
//            http_response_code(404);
//            $app->error();
//            break;
//    }
//}



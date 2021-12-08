<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';

use App\Controller\AppController;
use App\Controller\PostController;
use App\Controller\AuthorController;
use App\Controller\SecurityController;

$request = $_SERVER['REQUEST_URI'];
$app = new AppController();
$post = new PostController();
$author = new AuthorController();
$security = new SecurityController();

if (str_ends_with($request, '/')) {
    $request = substr($request, 0, -1);
}

if (preg_match('/\/admin/', $request) && !preg_match('/\/admin\/login/',$request))
{
    if (isset($_SESSION['admin']))
    {
        switch ($request) {
            case '/admin':
                echo 'Hello Admin';
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

if ($_GET) {
    switch ($request) {
        case '/author/edit?id=' . $_GET['id']:
            if (preg_match('/^\d+$/', $_GET['id'])) {
                $author->save($_GET['id']);
            } else {
                echo 'invalid ID';
            }
            break;
        case '/author/delete?id=' . $_GET['id']:
            if (preg_match('/^\d+$/', $_GET['id'])) {
                $author->deleteAuthor($_GET['id']);
            } else {
                echo 'invalid ID';
            }
            break;
        default:
            http_response_code(404);
            $app->error();
            break;
    }
}
else {
    switch ($request) {
        case '/home':
        case '/':
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
            $security->login();
            break;
        default:
            http_response_code(404);
            $app->error();
            break;
    }
}

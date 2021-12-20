<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';

use App\Router\Router;

$router = new Router($_GET['url']);

$router->get('/' , 'App#index');
$router->post('/' , 'App#index');
$router->get('/authors' , 'App#authors');
$router->get('/posts' , 'App#posts');
$router->get('/register' , 'App#register');
$router->get('/login' , 'Security#loginAuthor');
$router->get('/admin/login' , 'Security#loginAdmin');
$router->get('/admin/manager/new' , 'Manager#save');
$router->get('/admin' , 'Admin#dashboard');

//$router->get('/post/:id-:slug' , function ($id, $slug) use ($router){
//
//    echo $router->url('Post#save', ['id'=>$id, 'slug'=>$slug]);
//
//}, 'post.show')->with('id', '[0-9]+')->with('slug', '[a-z\-0-9]+');
//
//$router->get('/post/:id', 'Post#save');

try {
    $router->start();
} catch (Exception $e) {
    echo $e;
}


//if (preg_match('/\/admin/', $request) && !preg_match('/\/admin\/login/', $request) && !preg_match('/\/admin\/manager\/new/', $request)) {
//    if (isset($_SESSION['manager'])) {
//
//        if ($_GET) {
//            switch ($request) {
//                case '/admin/author/edit?id=' . $_GET['id']:
//                    if (preg_match('/^\d+$/', $_GET['id'])) {
//                        $author->save($_GET['id']);
//                    } else {
//                        echo 'invalid ID';
//                    }
//                    break;
//                case '/admin/author/delete?id=' . $_GET['id']:
//                    if (preg_match('/^\d+$/', $_GET['id'])) {
//                        $author->deleteAuthor($_GET['id']);
//                    } else {
//                        echo 'invalid ID';
//                    }
//                    break;
//                case '/admin/manager/edit?id=' . $_GET['id']:
//                    if (preg_match('/^\d+$/', $_GET['id'])) {
//                        $manager->save($_GET['id']);
//                    } else {
//                        echo 'invalid ID';
//                    }
//                    break;
//                case '/admin/manager/delete?id=' . $_GET['id']:
//                    if (preg_match('/^\d+$/', $_GET['id'])) {
//                        $manager->deleteManager($_GET['id']);
//                    } else {
//                        echo 'invalid ID';
//                    }
//                    break;
//                default:
//                    http_response_code(404);
//                    $app->error();
//                    break;
//            }
//        }
//
//        switch ($request) {
//            case '/admin':
//            case '/admin/dashboard':
//                $admin->dashboard();
//                break;
//            case '/admin/authors':
//                $author->list();
//                break;
//            case '/admin/author/new':
//                $author->save();
//                break;
//            case '/admin/posts':
//                $post->list();
//                break;
//            case '/admin/post/new':
//                $post->save();
//                break;
//            case '/admin/managers':
//                $manager->list();
//                break;
//            case '/admin/manager/new':
//                $manager->save();
//                break;
//            default:
//                http_response_code(404);
//                $app->error();
//                break;
//        }
//    } else {
//        header('Refresh:0; url=/admin/login');
//    }


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



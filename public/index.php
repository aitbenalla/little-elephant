<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';

use App\Router\Router;

$router = new Router($_GET['url']);

$router->any('/' , 'App#index');
$router->get('/authors' , 'App#authors');
$router->get('/posts' , 'App#posts');
$router->any('/register' , 'App#register');
$router->any('/login' , 'Security#loginAuthor');
$router->get('/logout' , 'Security#logoutAuthor');
$router->get('/profile/:username' , 'App#profile');
$router->any('/me' , 'Profile#dashboard');
$router->any('/create' , 'App#create');
$router->get('/admin' , 'Admin#dashboard');
$router->get('/admin/dashboard' , 'Admin#dashboard');
$router->get('/admin/authors' , 'Author#list');
$router->any('/admin/author/new' , 'Author#save');
$router->get('/admin/posts' , 'Post#list');
$router->any('/admin/post/new' , 'Post#save');
$router->get('/admin/managers' , 'Manager#list');
$router->any('/admin/manager/new' , 'Manager#save');
$router->any('/admin/login' , 'Security#loginAdmin');
$router->get('/admin/logout' , 'Security#logoutAdmin');

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
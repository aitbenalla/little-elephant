<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';

use App\Router\Router;

$router = new Router($_GET['url']);

// ##### App Section ##### //
# Home Controller
$router->any('/' , 'Home#index#App');
# Author Controller
$router->get('/authors' , 'Author#show#App');
$router->any('/register' , 'Author#register#App');
$router->get('/profile/:username' , 'Author#profile#App');
# Post Controller
$router->get('/posts' , 'Post#show#App');
$router->any('/post/new' , 'Post#save#App');
$router->any('/post/update/:id' , 'Post#save#App');
$router->any('/post/:slug' , 'Post#post#App');
# Security Controller
$router->any('/login' , 'Security#loginAuthor');
$router->get('/logout' , 'Security#logoutAuthor');
# Profile Controller
$router->any('/me' , 'Profile#dashboard#App');

// ##### Admin Section ##### //
# Dashboard Controller
$router->get('/admin' , 'Dashboard#dashboard#Admin');
$router->get('/admin/dashboard' , 'Dashboard#dashboard#Admin');
# Author Controller
$router->get('/admin/authors' , 'Author#list#Admin');
$router->any('/admin/author/new' , 'Author#save#Admin');
# Post Controller
$router->get('/admin/posts' , 'Post#list#Admin');
$router->any('/admin/post/new' , 'Post#save#Admin');
# Manager Controller
$router->get('/admin/managers' , 'Manager#list#Admin');
$router->any('/admin/manager/new' , 'Manager#save#Admin');
# Security Controller
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
<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';
use App\Controller\AppController;
$request = $_SERVER['REQUEST_URI'];
$app = new AppController();

switch ($request) {
    case '/' :
        $app->index();
        break;
    case '/home' :
        $app->index();
        break;
    case '/list' :
        $app->list();
        break;
    case '/add':
        $app->add();
        break;
    default:
        http_response_code(404);
        $app->error();
        break;
}
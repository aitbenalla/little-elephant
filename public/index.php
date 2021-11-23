<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';

use App\Controller\AppController;

$request = $_SERVER['REQUEST_URI'];
$app = new AppController();

if ($_GET) {
    switch ($request) {
        case '/edit_member?id=' . $_GET['id']:
            if (preg_match('/^\d+$/', $_GET['id'])) {
                $app->save($_GET['id']);
            } else {
                echo 'invalid ID';
            }
            break;
        case '/delete_member?id=' . $_GET['id']:
            if (preg_match('/^\d+$/', $_GET['id'])) {
                $app->deleteMember($_GET['id']);
            } else {
                echo 'invalid ID';
            }
            break;
        default:
            http_response_code(404);
            $app->error();
            break;
    }
} else {

    switch ($request) {
        case '/':
            $app->index();
            break;
        case '/home':
            $app->index();
            break;
        case '/list':
            $app->list();
            break;
        case '/add':
            $app->save();
            break;
        default:
            http_response_code(404);
            $app->error();
            break;
    }
}

<?php
namespace App\Controller;

trait flash
{
    public function message(string $message, string $type,string $name): void
    {
        // remove existing message with the name
//        if (isset($_SESSION['flash'])) {
//            unset($_SESSION['flash']);
//        }
        // add the message to the session
        $_SESSION['flash'][$name] = ['message' => $message, 'type' => $type];
    }
}
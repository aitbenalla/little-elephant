<?php
require_once('Database.class.php');

// Connection Object
$conf = new Database();
$server = $conf->getServer();
$connection = $conf->getConnection();


function getAlert($type, $page, $message)
{
    // Connection Redirect
    $servername = $_SERVER['HTTP_HOST'];
    $protocol = stripos($_SERVER['SERVER_PROTOCOL'], 'https') === 0 ? 'https://' : 'http://';
    $url_host = $protocol . $servername;

    return header("Location: $url_host/dev/little-elephant/$page?$type=$message");
    exit;
}

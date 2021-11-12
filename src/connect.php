<?php
require_once('Database.class.php');

// Connection Config
$env_file = dirname(getcwd()) . "/.env.json";

if (file_exists($env_file) && is_readable($env_file)) {
    $env_content = file_get_contents($env_file);
    $env = json_decode($env_content, true);
} else {
    getAlert('error', '', 'Database configuration not found or not readable');
}

// Connection Object
$conf = new Database($env['servername'], $env['username'], $env['password']);
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

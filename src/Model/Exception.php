<?php
namespace App\Model;
class Exception
{
    public function getAlert($type, $page, $message)
    {
        // Connection Redirect
        $servername = $_SERVER['HTTP_HOST'];
        $protocol = stripos($_SERVER['SERVER_PROTOCOL'], 'https') === 0 ? 'https://' : 'http://';
        $url_host = $protocol . $servername;
die;
        return header("Location: $url_host/?$type=$message");
        exit;
    }
}

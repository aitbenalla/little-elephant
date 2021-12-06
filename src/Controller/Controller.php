<?php

namespace App\Controller;

use App\Model\Database;
use SmartyBC;

class Controller extends SmartyBC
{

    function __construct()
    {
        if(!isset($_SESSION))
        {
            session_start();
        }
        // Class Constructor.
        // These automatically get set with each new instance.

        parent::__construct();

        $this->setTemplateDir(getcwd() . '/../templates/');
        $this->setCompileDir(getcwd() . '/../var/templates_c/');
        $this->setConfigDir(getcwd() . '/../configs/');
        $this->setCacheDir(getcwd() . '/../var/cache/');
        $this->caching = SmartyBC::CACHING_LIFETIME_CURRENT;

        $this->error_reporting = E_ERROR | E_WARNING | E_PARSE;

        $this->setCaching(true);
        $this->clearAllCache();

        $this->registerPlugin("modifier", 'base64_encode',  'base64_encode');

    }

    public function getDB()
    {
        return new Database();
    }

    function flash(string $message, string $type): void
    {
        // remove existing message with the name
        if (isset($_SESSION['flash'])) {
            unset($_SESSION['flash']);
        }
        // add the message to the session
        $_SESSION['flash'] = ['message' => $message, 'type' => $type];
    }
}

<?php

namespace App\Controller;

use App\Model\Database;
use SmartyBC;

class Controller extends SmartyBC
{
    const email_pattern = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i";
    const username_pattern = "/^[a-zA-Z0-9]{5,}$/";
    const pass_pattern = "/^.{8,}$/";
    const phone_pattern = "/^[0-9]{10}+$/";
    const full_name_pattern = "/^([a-zA-Z' ]+)$/";

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

    public function flash(string $message, string $type,string $name): void
    {
        // remove existing message with the name
//        if (isset($_SESSION['flash'])) {
//            unset($_SESSION['flash']);
//        }
        // add the message to the session
        $_SESSION['flash'][$name] = ['message' => $message, 'type' => $type];
    }

    public function validateAge($date): bool
    {
        $age = 18;
        $birthday = date("d-m-Y", strtotime($date));

        // $birthday can be UNIX_TIMESTAMP or just a string-date.
        if (is_string($birthday)) {
            $birthday = strtotime($birthday);
        }

        // check
        // 31536000 is the number of seconds in a 365 days year.
        if (time() - $birthday < $age * 31536000) {
            return false;
        }

        return true;
    }

    public function hashThePass($pass): string
    {
        $options = [
            'cost' => 12,
        ];
        return password_hash($pass, PASSWORD_BCRYPT, $options);
    }

    public function persist($post)
    {

    }
}

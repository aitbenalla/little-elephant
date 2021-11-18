<?php

namespace App\Controller;

use App\Model\Database;
use Smarty;

class Controller extends Smarty
{

    function __construct()
    {

        // Class Constructor.
        // These automatically get set with each new instance.

        parent::__construct();

        $this->setTemplateDir(getcwd() . '/../templates/');
        $this->setCompileDir(getcwd() . '/../var/templates_c/');
        $this->setConfigDir(getcwd() . '/../configs/');
        $this->setCacheDir(getcwd() . '/../var/cache/');
        $this->caching = Smarty::CACHING_LIFETIME_CURRENT;

        $this->setCaching(true);
        $this->clearAllCache();
    }

    public function getDB()
    {
        return new Database();
    }
}

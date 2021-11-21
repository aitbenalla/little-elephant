<?php
namespace App\Controller;

use App\Model\Database;
use Smarty;

class Controller extends Smarty
{

    function __construct()
    {
        session_start();
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

        $this->registerPlugin("modifier",'base64_encode',  'base64_encode');
    }

    public function getDB()
    {
        return new Database();
    }

    public function render($page, Array $val){
        $this->assign('flash', ['type' => $val[0], 'message' => $val[1]]);
        $this->display($page);
    }
}

<?php

namespace App\Controller;

use App\Entity\Manager;
use App\Model\ManagerRepository;
use SmartyException;

class AdminController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!isset($_SESSION['manager']))
        {
            header("Refresh:0; url=/admin/login");
            exit();
        }
    }

    /**
     * @throws SmartyException
     */
    public function dashboard()
    {
        $this->display('admin/dashboard.tpl');
    }

}
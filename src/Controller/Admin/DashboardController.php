<?php

namespace App\Controller\Admin;

use App\Controller\Controller;
use SmartyException;
class DashboardController extends Controller
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
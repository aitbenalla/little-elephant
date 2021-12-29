<?php

namespace App\Controller\App;

use App\Controller\Controller;
use JetBrains\PhpStorm\NoReturn;
use SmartyException;

class ProfileController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!isset($_SESSION['author']))
        {
            header("Refresh:0; url=/login");
            exit();
        }
    }

    /**
     * @throws SmartyException
     */
    #[NoReturn]
    public function dashboard()
    {
        if (isset($_SESSION['author']))
        {
            $this->display('app/profile/dashboard.tpl');
        }
        else
        {
            header("Refresh:0; url=/login");
            exit;
        }
    }
}
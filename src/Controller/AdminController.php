<?php

namespace App\Controller;

use App\Entity\Manager;
use App\Model\ManagerRepository;
use SmartyException;

class AdminController extends Controller
{
    /**
     * @throws SmartyException
     */
    public function dashboard()
    {
        $this->display('admin/dashboard.tpl');
    }

}
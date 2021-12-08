<?php

namespace App\Controller;

use SmartyException;

class SecurityController extends Controller
{
    /**
     * @throws SmartyException
     */
    public function login()
    {
        $this->display('security/login.tpl');
    }
}
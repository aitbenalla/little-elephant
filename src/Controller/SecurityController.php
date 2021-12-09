<?php

namespace App\Controller;

use App\Model\AdminRepository;
use SmartyException;

class SecurityController extends Controller
{
    /**
     * @throws SmartyException
     */
    public function login()
    {
        if (isset($_POST['login']))
        {
            $repository = new AdminRepository();
            $email = htmlentities($_POST['email']);
            $password = htmlentities($_POST['password']);

            $auth =$repository->getAuth($email, $password);

            var_dump($auth);

        }
        $this->display('security/login.tpl');
    }
}
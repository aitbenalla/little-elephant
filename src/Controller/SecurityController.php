<?php

namespace App\Controller;

use App\Entity\Admin;
use App\Model\AdminRepository;
use SmartyException;

class SecurityController extends Controller
{
    /**
     * @throws SmartyException
     */
    public function loginAdmin()
    {

        if (isset($_POST['login'])) {
            $repository = new AdminRepository();
            $email = htmlentities($_POST['email']);
            $password = htmlentities($_POST['password']);

            $admin = $repository->getAuth($email);

            if (password_verify($password, $admin->getPassword())) {
                echo 'correct';

            } else {

                echo 'not correct';
            }
        }

        $this->display('security/login.tpl');
    }
}
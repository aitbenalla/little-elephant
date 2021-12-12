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
        if (!isset($_SESSION['admin']))
        {
            if (isset($_POST['login'])) {
                $repository = new AdminRepository();
                $email = htmlentities($_POST['email']);
                $password = htmlentities($_POST['password']);

                $admin = $repository->getAuth($email);

                if (password_verify($password, $admin->getPassword())) {
                    $_SESSION['admin'] = $admin;
                    header("Refresh:0; url=/admin");
                } else {
                    $this->flash('Authentication failed', 'danger');
                }
            }

            $this->display('security/login.tpl');
        }
        else {
            header("Refresh:0; url=/admin");
        }

    }
}
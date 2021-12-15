<?php

namespace App\Controller;

use App\Model\AdminRepository;
use App\Model\AuthorRepository;
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
            $this->assign('action','/admin/login');
            $this->display('security/login.tpl');
        }
        else {
            header("Refresh:0; url=/admin");
        }

    }

    /**
     * @throws SmartyException
     */
    public function loginAuthor()
    {
        if (!isset($_SESSION['author']))
        {
            if (isset($_POST['login'])) {
                $repository = new AuthorRepository();
                $email = htmlentities($_POST['email']);
                $password = htmlentities($_POST['password']);

                $author = $repository->getAuth($email);

                if (password_verify($password, $author->getPassword())) {
                    $_SESSION['author'] = $author;
                    header("Refresh:0; url=/home");
                } else {
                    $this->flash('Authentication failed', 'danger');
                }
            }
            $this->assign('action','/login');
            $this->display('security/login.tpl');
        }
        else {
            header("Refresh:0; url=/home");
        }
    }
}
<?php

namespace App\Controller;

use App\Model\ManagerRepository;
use App\Model\AuthorRepository;
use SmartyException;
class SecurityController extends Controller
{
    /**
     * @throws SmartyException
     */
    public function loginAdmin()
    {
        if (!isset($_SESSION['manager']))
        {
            if (isset($_POST['login'])) {
                $repository = new ManagerRepository();
                $email = htmlentities($_POST['email']);
                $password = htmlentities($_POST['password']);

                $manager = $repository->getAuth($email);

                if (is_object($manager))
                {
                    if (password_verify($password, $manager->getPassword())) {
                        $_SESSION['manager'] = $manager;
                        header("Refresh:0; url=/admin");
                    }
                }
                else
                {
                    $this->flash('Authentication failed', 'danger','ma_auth_error');
                    if ($manager)
                        $this->flash($manager,'danger','ma_auth_error2');
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
                    header("Refresh:0; url=/profile/".$author->getUsername());
                } else {
                    $this->flash('Authentication failed', 'danger', 'at_auth_error');
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
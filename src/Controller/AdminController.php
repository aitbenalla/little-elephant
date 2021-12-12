<?php

namespace App\Controller;

use App\Entity\Admin;
use App\Model\AdminRepository;
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

    /**
     * @throws SmartyException
     */
    public function save($id = null)
    {
        $repository = new AdminRepository();

        if (!$id) {
            $admin = new Admin();
        } else {
            $admin = $repository->getOneById($id);
            if ($admin) {
                $this->assign('author', $admin);
            }
        }

        if (isset($_POST['save'])) {

            foreach ($_POST as $key => $value) {
                switch ($key) {
                    case 'full_name':
                        if (preg_match(self::full_name_pattern, $value)) {
                            $admin->setFullName($value);
                        } else {
                            $this->flash('Invalid name given.', 'danger');
                            header("Refresh:0");
                            exit;
                        }
                        break;
                    case 'email':
                        // filter_var($value, FILTER_VALIDATE_EMAIL)
                        if (preg_match(self::email_pattern, $value)) {
                            $admin->setEmail(trim($value));
                        } else {
                            $this->flash('Invalid Email address.', 'danger');
                            header("Refresh:0");
                            exit;
                        }
                        break;
                    case 'password':
                        if (preg_match(self::pass_pattern, $value)) {
                            if ($value === $_POST['password_repeat']) {
                                $admin->setPassword($this->hashThePass($value));
                            } else {
                                $this->flash('Passwords not match.', 'danger');
                                header("Refresh:0");
                                exit;
                            }
                        } else {
                            $this->flash('Password not strong enough / Password too short.', 'danger');
                            header("Refresh:0");
                            exit;
                        }
                        break;
                    case 'role':
                    default:
                        break;
                }
            }

            $result = $repository->flush($admin);


            if ($result) {

                $this->flash('Saved. <a href="/admin">Go To List</a>', 'success');
            }
        }

        $this->display('admin/manager/form.tpl');
    }

}
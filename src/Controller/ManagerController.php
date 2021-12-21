<?php

namespace App\Controller;

use App\Entity\Manager;
use App\Model\ManagerRepository;
use SmartyException;

class ManagerController extends Controller
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
    public function list()
    {
        $repository = new ManagerRepository();

        $this->assign('managers', $repository->getAll());
        $this->display('admin/manager/list.tpl');
    }

    /**
     * @throws SmartyException
     */
    public function save($id = null)
    {
        $repository = new ManagerRepository();

        if (!$id) {
            $manager = new Manager();
        } else {
            $manager = $repository->getOneById($id);
            if ($manager) {
                $this->assign('manager', $manager);
            }
            else
            {
                $this->flash('Manager not found.', 'danger', 'ma_not_found');
                header("Refresh:0; url=/admin/managers");
                exit();
            }
        }

        if (isset($_POST['save'])) {

            foreach ($_POST as $key => $value) {
                switch ($key) {
                    case 'full_name':
                        if (preg_match(self::full_name_pattern, $value)) {
                            $manager->setFullName($value);
                        } else {
                            $this->flash('Invalid name given.', 'danger', 'fl_error');
                            header("Refresh:0");
                            exit;
                        }
                        break;
                    case 'email':
                        // filter_var($value, FILTER_VALIDATE_EMAIL)
                        if (preg_match(self::email_pattern, $value)) {
                            $manager->setEmail(trim($value));
                        } else {
                            $this->flash('Invalid Email address.', 'danger', 'email_error');
                            header("Refresh:0");
                            exit;
                        }
                        break;
                    case 'password':
                        if (preg_match(self::pass_pattern, $value)) {
                            if ($value === $_POST['password_repeat']) {
                                $manager->setPassword($this->hashThePass($value));
                            } else {
                                $this->flash('Passwords not match.', 'danger', 'ps_error');
                                header("Refresh:0");
                                exit;
                            }
                        } else {
                            $this->flash('Password not strong enough / Password too short.', 'danger', 'ps_error2');
                            header("Refresh:0");
                            exit;
                        }
                        break;
                    case 'role':
                    default:
                        break;
                }
            }

            $result = $repository->flush($manager);


            if ($result) {

                $this->flash('Saved. <a href="/admin/managers">Go To List</a>', 'success', 'mn_saved');
            }
        }

        $this->display('admin/manager/form.tpl');
    }
}
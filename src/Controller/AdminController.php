<?php

namespace App\Controller;

use App\Entity\Admin;
use App\Entity\Media;
use App\Model\AdminRepository;
use App\Model\MediaRepository;
use SmartyException;

class AdminController extends Controller
{
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

            if ($result && !empty($_FILES["photo"]["name"])) {
                $media = new Media();
                $mediaRepository = new MediaRepository();
                $imgData = file_get_contents($_FILES['photo']['tmp_name']);
                $imgName = basename($_FILES["photo"]["name"]);
                $imgType = pathinfo($imgName, PATHINFO_EXTENSION);

                $media->setName($imgData);
                $media->setType($imgType);
                $media->setAuthor($result);

                $mediaRepository->flush($media, $id);
            }

            if ($result) {

                $this->flash('Saved. <a href="/admin">Go To List</a>', 'success');
            }
        }

        $this->display('admin/form.tpl');
    }
}
<?php

namespace App\Controller\Admin;

use App\Controller\Controller;
use App\Entity\Author;
use App\Entity\MediaAuthor;
use App\Model\AuthorRepository;
use App\Model\MediaAuthorRepository;
use SmartyException;

class AuthorController extends Controller
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
        $repository = new AuthorRepository();

        $this->display('admin/author/list.tpl', ['authors' => $repository->getAll()]);
    }

    /**
     * @throws SmartyException
     */
    public function save($id = null)
    {
        $repository = new AuthorRepository();

        if (!$id) {
            $author = new Author();
        } else {

            $author = $repository->getOneById($id);

            if ($author) {
                $this->assign('author', $author);
            }
            else
            {
                $this->flash('Author not found.', 'danger', 'au_not_found');
                header("Refresh:0; url=/admin/authors");
                exit();
            }
        }

        if (isset($_POST['save'])) {

            foreach ($_POST as $key => $value) {
                switch ($key) {
                    case 'full_name':
                        if (preg_match(self::full_name_pattern, $value)) {
                            $author->setFullName($value);
                        } else {
                            $this->flash('Invalid name given.', 'danger', 'fl_error');
                            header("Refresh:0");
                            exit;
                        }
                        break;
                    case 'birth_date':
                        if ($this->validateAge($value)) {
                            $author->setBirthDate($value);
                        } else {
                            $this->flash('You Must be 18 or Older.', 'danger', 'bd_error');
                            header("Refresh:0");
                            exit;
                        }
                        break;
                    case 'username':
                        if (preg_match(self::username_pattern, $value)) {
                            $author->setUsername($value);
                        } else {
                            $this->flash('Invalid username.', 'danger', 'us_error');
                            header("Refresh:0");
                            exit;
                        }
                        break;
                    case 'phone':
                        if (preg_match(self::phone_pattern, $value)) {
                            $author->setPhone(trim($value));
                        } else {
                            $this->flash('Invalid phone number.', 'danger', 'ph_error');
                            header("Refresh:0");
                            exit;
                        }
                        break;
                    case 'email':
                        // filter_var($value, FILTER_VALIDATE_EMAIL)
                        if (preg_match(self::email_pattern, $value)) {
                            $author->setEmail(trim($value));
                        } else {
                            $this->flash('Invalid Email address.', 'danger', 'email_error');
                            header("Refresh:0");
                            exit;
                        }
                        break;
                    case 'password':
                        if (preg_match(self::pass_pattern, $value)) {
                            if ($value === $_POST['password_repeat']) {
                                $author->setPassword($this->hashThePass($value));
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
                    case 'address':
                        $author->setAddress($value);
                        break;
                    case 'city':
                        $author->setCity(trim($value));
                        break;
                    case 'country':
                        $author->setCountry(trim($value));
                        break;
                    case 'zip':
                        $author->setZip(trim($value));
                        break;
                    default:
                        break;
                }
            }

            $result = $repository->flush($author);

            if ($result && !empty($_FILES["photo"]["name"])) {
                $media = new MediaAuthor();
                $mediaRepository = new MediaAuthorRepository();
                $imgData = file_get_contents($_FILES['photo']['tmp_name']);
                $imgName = basename($_FILES["photo"]["name"]);
                $imgType = pathinfo($imgName, PATHINFO_EXTENSION);

                $media->setName($imgData);
                $media->setType($imgType);
                $media->setAuthor($result);

                $mediaRepository->flush($media, $id);
            }

            if ($result) {

                $this->flash('Saved. <a href="/authors">Go To List</a>', 'success', 'au_saved');
            }
        }

        $this->display('admin/author/form.tpl');
    }

    public function deleteAuthor(int $id)
    {
        $repository = new AuthorRepository();

        $delete = $repository->delete($id);

        if ($delete) {

            $this->flash('Author Deleted', 'danger');

            header("Refresh:0; url=/authors");
        }
    }
}
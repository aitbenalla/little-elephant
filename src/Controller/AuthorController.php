<?php

namespace App\Controller;

use App\Entity\Media;
use App\Entity\Author;
use App\Model\AuthorRepository;
use App\Model\MediaRepository;
use SmartyException;
class AuthorController extends Controller
{
    const email_pattern = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i";
    const username_pattern = "/^[a-zA-Z0-9]{5,}$/";
    const pass_pattern = "/^.{8,}$/";
    const phone_pattern = "/^[0-9]{10}+$/";
    const full_name_pattern = "/^([a-zA-Z' ]+)$/";

    /**
     * @throws SmartyException
     */
    public function list()
    {
        $repository = new AuthorRepository();

        $authors = $repository->getAll();

        $this->display('author/list.tpl', ['authors' => $authors]);
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
        }

        if (isset($_POST['save'])) {

            foreach ($_POST as $key => $value) {
                switch ($key) {
                    case 'full_name':
                        if (preg_match(self::full_name_pattern, $value)) {
                            $author->setFullName($value);
                        } else {
                            $this->flash('Invalid name given.', 'danger');
                            header("Refresh:0");
                            exit;
                        }
                        break;
                    case 'birth_date':
                        if ($this->validateAge($value)) {
                            $author->setBirthDate($value);
                        } else {
                            $this->flash('You Must be 18 or Older.', 'danger');
                            header("Refresh:0");
                            exit;
                        }
                        break;
                    case 'username':
                        if (preg_match(self::username_pattern, $value)) {
                            $author->setUsername($value);
                        } else {
                            $this->flash('Invalid username.', 'danger');
                            header("Refresh:0");
                            exit;
                        }
                        break;
                    case 'phone':
                        if (preg_match(self::phone_pattern, $value)) {
                            $author->setPhone(trim($value));
                        } else {
                            $this->flash('Invalid phone number.', 'danger');
                            header("Refresh:0");
                            exit;
                        }
                        break;
                    case 'email':
                        // filter_var($value, FILTER_VALIDATE_EMAIL)
                        if (preg_match(self::email_pattern, $value)) {
                            $author->setEmail(trim($value));
                        } else {
                            $this->flash('Invalid Email address.', 'danger');
                            header("Refresh:0");
                            exit;
                        }
                        break;
                    case 'password':
                        if (preg_match(self::pass_pattern, $value)) {
                            if ($value === $_POST['password_repeat']) {
                                $author->setPassword($this->hashThePass($value));
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

                $this->flash('Saved. <a href="/authors">Go To List</a>', 'success');
            }
        }

        $this->display('author/form.tpl');
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

    private function validateAge($date): bool
    {
        $age = 18;
        $birthday = date("d-m-Y", strtotime($date));

        // $birthday can be UNIX_TIMESTAMP or just a string-date.
        if (is_string($birthday)) {
            $birthday = strtotime($birthday);
        }

        // check
        // 31536000 is the number of seconds in a 365 days year.
        if (time() - $birthday < $age * 31536000) {
            return false;
        }

        return true;
    }

    private function hashThePass($pass): string
    {
        $options = [
            'cost' => 12,
        ];
        return password_hash($pass, PASSWORD_BCRYPT, $options);
    }
}
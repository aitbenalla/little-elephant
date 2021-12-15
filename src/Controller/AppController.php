<?php

namespace App\Controller;

use App\Entity\Author;
use App\Entity\MediaAuthor;
use App\Model\AuthorRepository;
use App\Model\MediaAuthorRepository;
use SmartyException;
class AppController extends Controller
{
    /**
     * @throws SmartyException
     */
    public function index()
    {
        if (isset($_POST['db_execute']) && !empty($_POST['db_execute'])) {
            if (is_object($this->getDB()->getServer())) {

                if ($_POST['db_execute'] === '1') {
                    $this->flash('Connection succeeded', 'success');
                }
                if ($_POST['db_execute'] === '2') {
                    $creating = $this->getDB()->createDatabase();

                    if ($creating === true) {
                        $this->flash('Database created successfully', 'success');
                    } else {
                        $this->flash($creating, 'danger');
                    }
                }
                if ($_POST['db_execute'] === '3' && is_object($this->getDB()->getConnection())) {
                    $author = $this->getDB()->createTableAuthor();
                    $mediaAuthor = $this->getDB()->createTableMediaAuthor();
                    $post = $this->getDB()->createTablePost();
                    $mediaPost = $this->getDB()->createTableMediaPost();
                    $admin = $this->getDB()->createTableAdmin();

                    if ($author === true
                        && $mediaAuthor === true
                        && $post === true
                        && $mediaPost === true
                        && $admin === true
                    ) {
                        $this->flash('Tables created successfully', 'success');
                    } else {
                        $this->flash('Tables cannot be created or all ready created', 'danger');
                    }
                } else if ($_POST['db_execute'] === '3' && !is_object($this->getDB()->getConnection())) {
                    $this->flash($this->getDB()->getConnection(), 'danger');
                }
            } else {
                $this->flash($this->getDB()->getServer(), 'danger');
            }
        }

        $this->display('home.tpl');
    }

    /**
     * @throws SmartyException
     */
    public function authors()
    {
        $repository = new AuthorRepository();

        $authors = $repository->getAll();

        $this->display('authors.tpl', ['authors' => $authors]);
    }

    /**
     * @throws SmartyException
     */
    public function posts()
    {
        $this->display('posts.tpl');
    }

    /**
     * @throws SmartyException
     */
    public function register($id = null)
    {
        $repository = new AuthorRepository();

        $author = new Author();

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

                $this->flash('Saved. <a href="/authors">Go To List</a>', 'success');
            }
        }

        $this->display('register.tpl');
    }

    public function error()
    {
        echo '404';
    }
}

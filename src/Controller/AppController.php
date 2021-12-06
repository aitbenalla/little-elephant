<?php

namespace App\Controller;

use App\Entity\Media;
use App\Entity\Member;
use App\Model\MemberRepository;
use App\Model\MediaRepository;
use SmartyException;

class AppController extends Controller
{

    const email_pattern = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i";
    const username_pattern = "/^[a-zA-Z0-9]{5,}$/";
    const pass_pattern = "/^.{8,}$/";
    const phone_pattern = "/^[0-9]{10}+$/";
    const full_name_pattern = "/^([a-zA-Z' ]+)$/";

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
                    $member = $this->getDB()->createTableAuthor();
                    $media = $this->getDB()->createTableMedia();

                    if ($member === true && $media === true) {
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
    public function list()
    {
        $repository = new MemberRepository();

        $members = $repository->getAll();

        $this->display('list.tpl', ['members' => $members]);
    }

    /**
     * @throws SmartyException
     */
    public function save($id = null)
    {
        $repository = new MemberRepository();

        if (!$id) {
            $member = new Member();
        } else {

            $member = $repository->getOneById($id);

            if ($member) {
                $this->assign('member', $member);
            }
        }

        if (isset($_POST['save'])) {

            foreach ($_POST as $key => $value) {
                switch ($key) {
                    case 'full_name':
                        if (preg_match(self::full_name_pattern, $value)) {
                            $member->setFullName($value);
                        } else {
                            $this->flash('Invalid name given.', 'danger');
                            header("Refresh:0");
                            exit;
                        }
                        break;
                    case 'birth_date':
                        if ($this->validateAge($value)) {
                            $member->setBirthDate($value);
                        } else {
                            $this->flash('You Must be 18 or Older.', 'danger');
                            header("Refresh:0");
                            exit;
                        }
                        break;
                    case 'username':
                        if (preg_match(self::username_pattern, $value)) {
                            $member->setUsername($value);
                        } else {
                            $this->flash('Invalid username.', 'danger');
                            header("Refresh:0");
                            exit;
                        }
                        break;
                    case 'phone':
                        if (preg_match(self::phone_pattern, $value)) {
                            $member->setPhone(trim($value));
                        } else {
                            $this->flash('Invalid phone number.', 'danger');
                            header("Refresh:0");
                            exit;
                        }
                        break;
                    case 'email':
                        // filter_var($value, FILTER_VALIDATE_EMAIL)
                        if (preg_match(self::email_pattern, $value)) {
                            $member->setEmail(trim($value));
                        } else {
                            $this->flash('Invalid Email address.', 'danger');
                            header("Refresh:0");
                            exit;
                        }
                        break;
                    case 'password':
                        if (preg_match(self::pass_pattern, $value)) {
                            if ($value === $_POST['password_repeat']) {
                                $member->setPassword($this->hashThePass($value));
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
                        $member->setAddress($value);
                        break;
                    case 'city':
                        $member->setCity(trim($value));
                        break;
                    case 'country':
                        $member->setCountry(trim($value));
                        break;
                    case 'zip':
                        $member->setZip(trim($value));
                        break;
                    default:
                        break;
                }
            }

            $result = $repository->flush($member);

            if ($result && !empty($_FILES["photo"]["name"])) {
                $media = new Media();
                $mediaRepository = new MediaRepository();
                $imgData = file_get_contents($_FILES['photo']['tmp_name']);
                $imgName = basename($_FILES["photo"]["name"]);
                $imgType = pathinfo($imgName, PATHINFO_EXTENSION);

                $media->setName($imgData);
                $media->setType($imgType);
                $media->setMember($result);

                $mediaRepository->flush($media, $id);
            }

            if ($result) {

                $this->flash('Saved. <a href="/list">Go To List</a>', 'success');
            }
        }

        $this->display('form.tpl');
    }

    public function error()
    {
        echo '404';
    }

    public function deleteMember(int $id)
    {
        $repository = new MemberRepository();

        $request = $repository->delete($id);

        if ($request) {

            $this->flash('Member Deleted', 'danger');

            header("Refresh:0; url=/list");
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

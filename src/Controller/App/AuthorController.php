<?php

namespace App\Controller\App;

use App\Controller\Controller;
use App\Controller\flash;
use App\Entity\MediaAuthor;
use App\Form\AuthorType;
use App\Form\MediaAuthorType;
use App\Model\AuthorRepository;
use App\Model\MediaAuthorRepository;
use DOMException;
use JetBrains\PhpStorm\NoReturn;
use SmartyException;
class AuthorController extends Controller
{
    use flash;
    /**
     * @throws SmartyException
     */
    public function show()
    {
        $repository = new AuthorRepository();
        $this->display('app/author/show.tpl', ['authors' => $repository->getAll()]);
    }

    /**
     * @throws SmartyException
     * @throws DOMException
     */
    public function register($id = null)
    {
        $repository = new AuthorRepository();
        $form = new AuthorType();

        if (isset($_POST['save'])) {

            $author = $form->submit($_POST);

            $result = $repository->flush($author);

            if ($result && !empty($_FILES["photo"]["name"])) {
                $mediaType = new MediaAuthorType();
                $media = $mediaType->submit($result);
                $mediaRepository = new MediaAuthorRepository();
                $mediaRepository->flush($media, $id);
            }

            if ($result) {

                $this->message('Saved. <a href="/authors">Go To List</a>', 'success', 'au_saved');
            }
        }

        $this->display('app/author/register.tpl', ['form'=>$form->buildForm()]);
    }

    /**
     * @throws SmartyException
     */
    #[NoReturn]
    public function profile($username)
    {
        $repository = new AuthorRepository();
        $profile = $repository->getOneByUsername($username);

        if (is_object($profile))
        {
            $this->display('app/author/profile.tpl', ['profile'=>$profile]);
        }
        else
        {
            $this->flash('Profile not found', 'danger', 'profile_not_found');
            header("Refresh:0; url=/");
            exit;
        }

    }
}